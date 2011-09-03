//(function($){
	if (!google.maps.Polygon.prototype.getBounds) {
		google.maps.Polygon.prototype.getBounds = function(latLng) {
			var bounds = new google.maps.LatLngBounds();
			var paths = this.getPaths();
			var path;

			for (var p = 0; p < paths.getLength(); p++) {
				path = paths.getAt(p);
				for (var i = 0; i < path.getLength(); i++) {
					bounds.extend(path.getAt(i));
				}
			}

			return bounds;
		}
	}

	if (!google.maps.Polygon.prototype.containsLatLng) {
		google.maps.Polygon.prototype.containsLatLng = function(latLng) {
			var bounds = this.getBounds();

			if (bounds != null && !bounds.contains(latLng)) {
				return false;
			}

			// Raycast point in polygon method
			var inPoly = false;

			var numPaths = this.getPaths().getLength();
			for (var p = 0; p < numPaths; p++) {
				var path = this.getPaths().getAt(p);
				var numPoints = path.getLength();
				var j = numPoints-1;

				for (var i=0; i < numPoints; i++) { 
					var vertex1 = path.getAt(i);
					var vertex2 = path.getAt(j);

					if (vertex1.lng() < latLng.lng() && vertex2.lng() >= latLng.lng() || vertex2.lng() < latLng.lng() && vertex1.lng() >= latLng.lng())  {
						if (vertex1.lat() + (latLng.lng() - vertex1.lng()) / (vertex2.lng() - vertex1.lng()) * (vertex2.lat() - vertex1.lat()) < latLng.lat()) {
							inPoly = !inPoly;
						}
					}

					j = i;
				}
			}

			return inPoly;
		}
	}
	
	if (!google.maps.LatLng.prototype.distanceFrom) {
		google.maps.LatLng.prototype.distanceFrom = function(latlng){
			if (!latlng) {
				return 0;
			}

			var R = 6371000; // Radius of the Earth in meters
			var dLat = (latlng.lat() - this.lat()) * Math.PI / 180;
			var dLon = (latlng.lng() - this.lng()) * Math.PI / 180;
			var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
				Math.cos(this.lat() * Math.PI / 180) * Math.cos(latlng.lat() * Math.PI / 180) *
				Math.sin(dLon / 2) * Math.sin(dLon / 2);
			var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
			var d = R * c;
			return d;
		};
	}
	
	if (!google.maps.Polygon.prototype.distanceFrom) {
		google.maps.Polygon.prototype.distanceFrom = function(latlng){
			if (this.containsLatLng(latlng)) return 0;
			
			var finalDistance = 2147483647, distance = 0,
				point, closestPointOnSegment, i, j, l1, l2, closest, finalClosest;
			
			point = { x: latlng.lng(), y: latlng.lat() };
			
			// Helper function that finds the closest point on a segment to another
			// arbitrary point.
			closestPointOnSegment = function(p, s) {
				var dx = s.p2.x - s.p1.x;
				var dy = s.p2.y - s.p1.y;
				
				var t = ((p.x - s.p1.x) * dx + (p.y - s.p1.y) * dy) / (dx * dx + dy * dy);
				
				if (t < 0)
					return { x: s.p1.x, y: s.p1.y };
				else if (t > 1)
					return { x: s.p2.x, y: s.p2.y };
				
				return { x: s.p1.x + t * dx, y: s.p1.y + t * dy };
			};
			
			// Loop through all verticies and find the distance from the given LatLng to
			// the closest point on the segment defined by the vertex and its following
			// vertex.
			var numPaths = this.getPaths().getLength();
			for (var p = 0; p < numPaths; p++) {
				var path = this.getPaths().getAt(p);
				var numPoints = path.getLength();
				j = numPoints - 1;
				
				for (var i = 0; i < numPoints; i++) { 
					var vertex1 = path.getAt(i);
					var vertex2 = path.getAt(j);

					l1 = { x: path.getAt(i).lng(), y: path.getAt(i).lat() };
					l2 = { x: path.getAt(j).lng(), y: path.getAt(j).lat() };
					closest = closestPointOnSegment(point, { p1: l1, p2: l2 });
					
					distance = latlng.distanceFrom(new google.maps.LatLng(closest.y, closest.x));
					
					if (distance < finalDistance) {
						finalDistance = distance;
						finalClosest = closest;
					}

					j = i;
				}
			}
			
			return finalDistance;
		};
	}


	if (!google.maps.Polygon.fromEncoded) {
		google.maps.Polygon.fromEncoded = function(encoded, polygonOptions){
			polygonOptions = polygonOptions || {};
			
			var path = [], i = -1, j = -1, k, l, q = encoded.match(/[\_-\~]*[\?-\^]/g), w = 0, x = 0, y = 0, z = 1e-5;

			if (q) for (;;) {
				if (!q[++i]) break;

				for (k = q[i].length, l = 63, w = 0; k--; l = 95) w = (w << 5) + q[i].charCodeAt(k) - l;

				y += (w << 31 >> 31) ^ (w >> 1);

				if (!q[++i]) break;

				for (k = q[i].length, l = 63, w = 0; k--; l = 95) w = (w << 5) + q[i].charCodeAt(k) - l;

				x += (w << 31 >> 31) ^ (w >> 1);

				path[++j] = new google.maps.LatLng(y * z, x * z);
			}
			
			polygonOptions.paths = path;

			return new google.maps.Polygon(polygonOptions);
		};
	}
	
	/**
	 * @class A generic collection of objects. Each object is expected to have an
	 * id property used by {@link ObjectCollection.getObjectById} to return objects.
	 */
	function ObjectCollection(){
		// Private self for closures.
		var _self = this;
		
		// Public members.
		/**
		 * {Object[]} The objects in the collection.
		 */
		this.objects = [];
		
		// Public methods.
		
		/**
		 * Adds an object to the collection.
		 * @param {Object} object The object to be added.
		 */
		this.addObject = function(object) {
			_self.objects.push(object);
		};
		
		/**
		 * Removes an object to the collection.
		 * @param {Object} object The object to be removed.
		 * @return {Boolean} True if the object was removed, false if it was not removed.
		 */
		this.removeObject = function(object) {
			for (var i = 0; i < _self.objects.Length; i++) {
				if (_self.objects[i] == object) {
					_self.objects.splice(i, 1);
					return true;
				}
			}
			
			return false;
		};
		
		/**
		 * Returns the first object with an id property matching the id parameter or
		 * null if no object was found.
		 * @param {Object|String|Number} id The id to match against.
		 * @return {Object} The object with a matching id property.
		 */
		this.getObjectById = function(id){
			for (var i = 0; i < _self.objects.length; i++) {
				if (_self.objects[i].id == id)
					return _self.objects[i];
			}
			
			return null;
		};
	};
	
	/**
	 * Creates a google.maps.Marker and google.maps.InfoWindow for the map.
	 * @class A location on the map, such as a service area.
	 * @param {Node}  The XML node from the XML data file that represents the location.
	 * @param {Object} icons A JavaScript object containing google.maps.MarkerImages keyed
	 * by the location type.
	 * @param {google.maps.Map} map The map where the location will be added.
	 */
	function Location(xml, icons, map){
		// Private self for closures.
		var _self = this;
		
		// Public members.
		/**
		 * {Node} The XML node from the XML data file that represents the location. 
		 */
		this.xml = xml;
		/**
		 * {String} The name of the location. 
		 */
		this.name = this.xml.getAttribute('name');
		/**
		 * {String} The address of the location. 
		 */
		this.address = this.xml.getAttribute('address');
		/**
		 * {google.maps.LatLng} The latitude and longitude of the location. 
		 */
		this.latlng = new google.maps.LatLng(this.xml.getAttribute('lat'), this.xml.getAttribute('lng'));
		/**
		 * {String} The type of the location, such as "dc". 
		 */
		this.type = this.xml.getAttribute('type');
		/**
		 * {google.maps.Marker} The location's marker on the map. 
		 */
		this.marker = null;
		/**
		 * {google.maps.InfoWindow} The location's info window, displayed when its marker is clicked. 
		 */
		this.infowindow = null;
		
		// Private members.
		var _icons = icons;
		var _map = map;
		
		// Public methods.		
		/**
		 * Hides the location's marker on the map.
		 */
		this.hide = function(){
			_self.marker.setVisible(false);
		};
		
		/**
		 * Shows the location's marker on the map.
		 */
		this.show = function(){
			_self.marker.setVisible(true);
		};
		
		/**
		 * Constructor.
		 */
		(function(){
			_self.marker = new google.maps.Marker({position: _self.latlng, icon: _icons[_self.type], shadow: _icons.shadow, shape: _icons.shape, map: _map, visible: false});
			
			var infoWindowText = '<p><strong>' + _self.name + '</strong><br />' + _self.address + '</p>';
			var details = $('details', _self.xml).text();
			if (details)
				infoWindowText += '<div>' + details + '</div>';
			
			_self.infowindow = new google.maps.InfoWindow({content: infoWindowText});
			google.maps.event.addListener(_self.marker, 'click', function(){
				_self.infowindow.open(_self.marker.getMap(), _self.marker);
				if (ServiceAreas.currentInfoWindow)
					ServiceAreas.currentInfoWindow.close();
					
				ServiceAreas.currentInfoWindow = _self.infowindow;
			});
		})();
	};
	
	/**
	 * Returns a new {@link PolygonGroup}.
	 * @class A group of {google.maps.Polygon} objects.
	 * @param {Node} xml The XML node from the XML data file that represents the polygon group.
	 * @param {google.maps.Map} map The map where the polygon group will be added.
	 */
	function PolygonGroup(xml, map){
		// Private self for closures.
		var _self = this;
		
		// Public members.
		/**
		 * {Node} The XML node from the XML data file that represents the location. 
		 */
		this.xml = xml;
		/**
		 * {String} The PolygonGroup's id. 
		 */
		this.id = this.xml.getAttribute('id');
		
		// Private members.
		var _polygons = [];
		var _lastOptions = null;
		var _map = map;
		
		// Public methods.
		
		/**
		 * Determines if a google.maps.LatLng is within any of the group's polygons.
		 * @param {google.maps.LatLng} latlng The google.maps.LatLng to check.
		 * @return {Boolean} True if one of the polygons contains the google.maps.LatLng, false if not.
		 */
		this.containsLatLng = function(latlng){
			for (var i = 0; i < _polygons.length; i++) {
				if (_polygons[i].containsLatLng(latlng))
					return true;
			}
			
			return false;
		};
		
		/**
		 * Finds the shortest distance from the group of polygons to the google.maps.LatLng.
		 * @param {google.maps.LatLng} latlng The google.maps.LatLng to check.
		 * @return {Number} The distance in miles from the closest polygon to the google.maps.LatLng.
		 */
		this.distanceToLatLng = function(latlng){
			var finalDistance = 2147483647, distance = 0;
			
			for (var i = 0; i < _polygons.length; i++) {
				distance = _polygons[i].distanceFrom(latlng);
				if (distance < finalDistance)
					finalDistance = distance;
			}
			
			// This multiplication returns the distance in miles.
			return finalDistance * 0.000621371192;
		};

		/**
		 * Updates all of the group's polygons with the provided options.
		 * @param {google.maps.PolygonOptions} The options to use.
		 */
		this.setPolygonOptions = function(polygonOptions){
			for (var i = 0; i < _polygons.length; i++) {
				_polygons[i].setOptions(polygonOptions) 
			}
		};
		
		/**
		 * Hides all of the group's polygons by removing them from the map.
		 */
		this.hide = function(){
			for (var i = 0; i < _polygons.length; i++) {
				_polygons[i].setMap(null);
			}
		};
		
		/**
		 * Shows all of the group's polygons by adding them to the map.
		 */
		this.show = function(){
			for (var i = 0; i < _polygons.length; i++) {
				_polygons[i].setMap(_map);
			}
		};
		
		
		/**
		 * Constructor.
		 */
		(function(){
			// Grab the polygons and filter them by the optional polygonFilter url query string value.
			var $polygons = $('polygon', _self.xml);
			var polygonFilter = $.url.param('polygonFilter');
			if (polygonFilter) {
				polygonFilter = polygonFilter.split(',');
				polygonFilter = $.map(polygonFilter, function(p){
					return '[id="' + p + '"]';
				});
				$polygons = $polygons.filter(polygonFilter.join(','));
			}
			
			// Create all of the polygons associated with this polygon group.
			$polygons.each(function(){
				var $polyData = $(this);
				var polygon = google.maps.Polygon.fromEncoded($polyData.find('encodedPoints').text(), {
					fillColor: '#FFFFFF',
					fillOpacity: 0,
					strokeColor: '#FFFFFF',
					strokeOpacity: '#FFFFFF',
					strokeWeight: 1
				});
				
				_polygons.push(polygon);
			});
			
			ServiceAreas.polygonGroups.addObject(_self);
		})();
	};
	
	/**
	 * @class The representation of a set of messages displayed depending on whether a
	 * searched address is inside, on the edge of, or outside the distribution area.
	 */
	function Message(xml){
		// Private self for closures.
		var _self = this;
		
		// Public members.
		/**
		 * {Node} The XML node from the XML data file that represents the messages. 
		 */
		this.xml = xml;
		/**
		 * {String} The unique id the the messages.
		 */
		this.id = this.xml.getAttribute('id');
		
		// Private members.

		// Private methods.
		
		/**
		 * Searches the XML structure of the messages for an element matching the type parameter
		 * and returns its textual representation. If the matched element has a "ref" attribute, the
		 * function is executed again using the value of the "ref" attribute as the type.
		 * @param {String} The type of message to return. Matches the element name in the XML structure.
		 * @return {String} The message as a string.
		 * @private
		 */
		var _getMessage = function(type){
			var $messageXml = $(type, _self.xml);
			// If the message has a 'ref' attribute, then get the message
			// from the type that it is referencing (the value of the attribute).
			if ($messageXml.is('[ref]')) {
				return _getMessage($messageXml.attr('ref'));
			}
			
			return $messageXml.text();
		};
		
		// Public methods.
		
		/**
		 * Retrieves the message to be shown when the search address is inside a distribution area.
		 * @return {String} The message as a string.
		 */
		this.getInsideMessage = function(){
			return _getMessage('inside');
		};
		
		/**
		 * Retrieves the message to be shown when the search address is on the edge of a distribution area.
		 * @return {String} The message as a string.
		 */
		this.getEdgeMessage = function(){
			return _getMessage('edge');
		};
		
		/**
		 * Retrieves the message to be shown when the search address is outside a distribution area.
		 * @return {String} The message as a string.
		 */
		this.getOutsideMessage = function(){
			return _getMessage('outside');
		};
		
		/**
		 * Constructor.
		 */
		(function(){
			ServiceAreas.messages.addObject(_self);
		})();
	};
	
	/**
	 * @class A distribution is an area of service coverage. It consists of one or more polygon groups,
	 * a fill and stroke style for the groups, and a set of locations. 
	 */
	function Distribution(xml, map){
		// Private self for closures.
		var _self = this;
		
		// Public members.
		/**
		 * {Node} The XML node from the XML data file that represents the distribution. 
		 */
		this.xml = xml;
		/**
		 * {String} The name of the distribution.
		 */
		this.name = this.xml.getAttribute('name');
		/**
		 * {String} The unique ID of the distribution.
		 */
		this.id = this.xml.getAttribute('id');
		/**
		 * {google.maps.Map} The distribution's Google Map object.
		 */
		this.map = map;
		
		// Private members.
		var _polygonGroups = [];
		var _polygonFillStyle = null;
		var _polygonStrokeStyle = null;
		var _locations = new ObjectCollection();
		
		// Public methods.
		
		/**
		 * Gets an appropriate {@link Message} based on the given adddress.
		 * @return {Message} A matching {@link Message} object for the address.
		 */
		this.getMessageFromAddress = function(address){
			var message = null;
			
			// Look through all message entries in this distribution and see
			// if any of the message patterns match the address. If so, return
			// that message object.
			$('messages > message', _self.xml).each(function(){
				var regex = new RegExp($(this).attr('pattern'));
				if (regex.test(address)) {
					message = ServiceAreas.messages.getObjectById($(this).attr('id'));
					return false;
				}
			});
			
			return message;
		};
		
		/**
		 * Provides whether the given google.maps.LatLng is within the distribution.
		 * @return {Boolnean} True if the google.maps.LatLng is within the distribution and false otherwise.
		 */
		this.containsLatLng = function(latlng){
			for (var i = 0; i < _polygonGroups.length; i++) {
				if (_polygonGroups[i].containsLatLng(latlng))
					return true;
			}
			
			return false;
		};
		
		/**
		 * Gives the distance from a google.maps.LatLng to the closest polygon in the distribution.
		 * A match is only successful if the given address matches the pattern defined for
		 * the polygon group being checked. For example, this prevents a location in northern
		 * Washington state from indicating service is provided due to the proximity to the
		 * Canadian service area.
		 * @param {String} address The address to match against.
		 * @param {google.maps.LatLng} The google.maps.LatLng of the address.
		 * @return {Number} The distance in miles from the closest matching polygon group.
		 */
		this.distanceToLatLng = function(address, latlng){
			var finalDistance = 2147483647, distance = 0;
			
			for (var i = 0; i < _polygonGroups.length; i++) {
				// Check to see if the address matches the pattern defined for this polygon group.
				// If not, skip this group.
				if (!(new RegExp($('polygonGroups > polygonGroup[id=' + _polygonGroups[i].id + ']', _self.xml).attr('pattern')).test(address)))
					continue;
					
				distance = _polygonGroups[i].distanceToLatLng(latlng);
				
				if (distance < finalDistance)
					finalDistance = distance;
			}
			
			return finalDistance;
		};
		
		/**
		 * Adds a {@link Location} to the distribution.
		 * @param {Location} The location to add.
		 */
		this.addLocation = function(location){
			_locations.addObject(location);
		};
		
		/**
		 * Removes a {@link Location} from the distribution.
		 * @param {Location} The location to remove.
		 */
		this.removeLocation = function(location){
			return _locations.removeObject(location);
		};
		
		/**
		 * Gets the fill style for this distributions {@link PolygonGroup}s.
		 * The fill style is a partial {maps.google.PolygonOptions} object.
		 * @return {maps.google.PolygonOptions} The distribution's fill style.
		 */
		this.getPolygonFillStyle = function(){
			return _polygonFillStyle;
		};
		
		/**
		 * Gets the stroke style for this distributions {@link PolygonGroup}s.
		 * The stroke style is a partial {maps.google.PolygonOptions} object.
		 * @return {maps.google.PolygonOptions} The distribution's stroke style.
		 */
		this.getPolygonStrokeStyle = function(){
			return _polygonStrokeStyle;
		};
		
		/**
		 * Hides the distribution by hiding all of its {@link PolygonGroup}s and {@link Location}s.
		 */
		this.hide = function(){
			for (var i = 0; i < _polygonGroups.length; i++) {
				_polygonGroups[i].hide();
			}
			
			for (i = 0; i < _locations.objects.length; i++) {
				_locations.objects[i].hide();
			}
		};
		
		/**
		 * Shows the distribution by showing all of its {@link PolygonGroup}s and {@link Location}s.
		 */
		this.show = function(){
			var i = 0;
			
			for (i = 0; i < _polygonGroups.length; i++) {
				_polygonGroups[i].setPolygonOptions(_self.getPolygonFillStyle());
				_polygonGroups[i].setPolygonOptions(_self.getPolygonStrokeStyle());
				_polygonGroups[i].show();
			}
			
			for (i = 0; i < _locations.objects.length; i++) {
				_locations.objects[i].show();
			}
		};
		
		/**
		 * Constructor.
		 */
		(function(){
			var $polygonGroups = $('polygonGroups', _self.xml);
			
			// Find the polygon groups for this distribution.
			$polygonGroups.children('polygonGroup').each(function(){
				var polygonGroup = ServiceAreas.polygonGroups.getObjectById($(this).attr('id'));
				if (polygonGroup != null) {
					//polygonGroup.addToMap(_self.map);
					_polygonGroups.push(polygonGroup);
				}
			});
			
			// Generate the polygon group fill style.
			_polygonFillStyle = {
				fillColor: '#' + $polygonGroups.attr('fill-color'),
				fillOpacity: Number($polygonGroups.attr('fill-opacity')) / 100
			};
			
			// Generate the polygon group stroke style.Hrm
			_polygonStrokeStyle = {
				strokeColor: '#' + $polygonGroups.attr('stroke-color'),
				strokeWeight: Number($polygonGroups.attr('stroke-weight')),
				strokeOpacity: Number($polygonGroups.attr('stroke-opacity')) / 100
			};
		})();
	};
	
	var ServiceAreas = null;
	/**
	 * @class ServiceAreas is a static class responsible for the bulk of the functionality and interactivity of the Service Areas application.
	 * @name ServiceAreas
	 * @static
	 */
	ServiceAreas = new (function(){
		// Private self for closures.
		var _self = this;
		
		// Private members.
		var _xmlData = null;
		var _xmlLocations = null;
		var _map = null;
		var _geocoder = null;
		var _icons = {
			store: null,
			dc: null,
			office: null,
			address: null,
			shadow: null
		};
		var _distributions = [];
		var _searchHistory = [];
		
		// Public members.
		/**
		 * {Object} Static configuration properties for the service areas.
		 * @memberOf ServiceAreas
		 * @name config
		 */
		this.config = {
			maxInfoWindowWidth: 250,
			initialZoom: 3,
			maxZoom: 11,
			centerLatLng: new google.maps.LatLng(57.891497, -95.453125),
			locationUrl: '/sites/all/themes/gfscanada/service-area-fr/service-areas-locations.xml',
			dataUrl: '/sites/all/themes/gfscanada/service-area-fr/service-areas-data.xml',
			bufferDistance: 50
		};
		/**
		 * {Distribution} The distribution currently being displayed on the map.
		 * @memberOf ServiceAreas
		 * @name currentDistribution
		 */
		this.currentDistribution = null;
		/**
		 * {google.maps.InfoWindow} The InfoWindow currently being displayed on the map.
		 * @memberOf ServiceAreas
		 * @name currentInfoWindow
		 */
		this.currentInfoWindow = null;
		/**
		 * {google.maps.Marker} The Marker for the address that was searched.
		 * @memberOf ServiceAreas
		 * @name searchMarker
		 */
		this.searchMarker = null;
		/**
		 * {google.maps.InfoWindow} The InfoWindow displayed when the search marker is clicked.
		 * @memberOf ServiceAreas
		 * @name searchInfoWindow
		 */
		this.searchInfoWindow = null;
		/**
		 * {ObjectCollection} A collection of all of the {@link PolygonGroup}s.
		 * @memberOf ServiceAreas
		 */
		this.polygonGroups = new ObjectCollection();
		/** 
		 * {ObjectCollection} A collection of all of the {@link Message}s.
		 * @memberOf ServiceAreas
		 */
		this.messages = new ObjectCollection();
		
		// Private methods.
		/**
		 * Processes the XML data into {@link PolygonGroup}s, {@link Message}s, and {@link Distribution}s.
		 * @param {Document} data A Document object representing the loaded XML data file.
		 * @private
		 * @memberOf ServiceAreas
		 * @name _processData
		 */
		var _processData = function(data){
			_xmlData = data;
			
			var $controls = $('#service-areas-controls');
			$controls.empty();
			
			// Create polygon groups.
			$('service-areas > polygonGroups > polygonGroup', data).each(function(){
				var polygonGroup = new PolygonGroup(this, _map);
			});
			
			// Create messages.
			$('service-areas > messages > message', data).each(function(){
				var message = new Message(this);
			});
			
			// Create distributions.
			$('service-areas > distributions > distribution', data).each(function(){
				var distribution = new Distribution(this, _map);
				_distributions.push(distribution);
				
				// Create the radio button for this distribution.
				var fillStyle = distribution.getPolygonFillStyle();
				var id = 'serviceAreasAreaType-' + distribution.id;
				var $container = $('<div class="service-areas-legend-entry"><span class="service-areas-legend-color-square">&nbsp;</span></div>');
				$container.find('.service-areas-legend-color-square').css('background', fillStyle.fillColor)
					.fadeTo(0, Math.max(0.4, fillStyle.fillOpacity));
				
				$radio = $('<input type="radio" id="' + id + '" name="serviceAreasAreaType" value="' + distribution.name + '" />');
				$radio.data('distribution', distribution);
				$radio.appendTo($container);
				
				$label = $('<label for="' + id + '">' + distribution.name + '</label>');
				$label.appendTo($container);
				
				$container.appendTo($controls);
			});
			
			// Process the custom controls on the radio buttons so that
			// they look pretty.
			//Forms.customControls($controls);
			
			_processComplete();
		};
		
		/**
		 * Processes the XML locations into {@link Location} objects.
		 * @param {Document} data A Document object representing the loaded XML location file.
		 * @private
		 * @memberOf ServiceAreas
		 * @name _processLocations
		 */
		var _processLocations = function(data){
			_xmlLocations = data;
			
			// Create locations.
			$('locations > location', data).each(function(){
				var location = new Location(this, _icons, _map);
				location.hide();
				
				// Associate the location with one or more distributions.
				for (var i = 0; i < _distributions.length; i++) {
					if (_distributions[i].containsLatLng(location.marker.getPosition()))
						_distributions[i].addLocation(location);
				}
			});
			
			_processComplete();
		};
		
		/**
		 * Executed after {@link ServiceAreas._processLocations} and {@link ServiceAreas._processData}.
		 * If both functions have completed when this function executes, it attaches click events to
		 * the distribution radio buttons and sets the "Restaurants, Healthcare, Education and Other Foodservice"
		 * distribution as the active distribution.
		 * @private
		 * @memberOf ServiceAreas
		 * @name _processComplete
		 */
		var _processComplete = function(){
			// Only run if both locations and map data have been loaded.
			if (_xmlLocations == null || _xmlData == null)
				return;
				
			// Bind a click handler that sets the active distribution associated with
			// the clicked radio button.
			$('#service-areas-controls input[type=radio]').click(function(){
				_self.setActiveDistribution($(this).data('distribution'));
			});
			
			$('#serviceAreasAreaType-restaurants').click();
		};
		
		// Public methods.
		
		/**
		 * Initializes the service areas by configuring Google Maps and requesting the
		 * XML data file and XML locations file.
		 * @memberOf ServiceAreas
		 * @name initialize
		 */
		this.initialize = function(){
			//G_NORMAL_MAP.getMaximumResolution = function(){ return _self.config.maxZoom; };
			
			var centerLatLng = $.url.param('centerLatLng');
			var initialZoom = $.url.param('initialZoom');
			if (centerLatLng)
				centerLatLng = new google.maps.LatLng(centerLatLng.split(',')[0], centerLatLng.split(',')[1]);
			if (initialZoom)
				initialZoom = Number(initialZoom);
				
			_self.config.centerLatLng = centerLatLng || _self.config.centerLatLng;
			_self.config.initialZoom = initialZoom || _self.config.initialZoom;
			
			// Setup the map.
			var mapOptions = {
				center: _self.config.centerLatLng,
				zoom: _self.config.initialZoom,
				mapTypeControl: false,
				streetViewControl: false,
				scrollwheel: false,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			_map = new google.maps.Map(document.getElementById('service-areas-map'), mapOptions);
			_self.map = _map;
			
			// Setup the supporting objects.
			_geocoder = new google.maps.Geocoder();
			_self.searchMarker = new google.maps.Marker({visible: false, map: _map, position: _self.config.centerLatLng});
			var shadow = _self.searchMarker.getShadow();
			_self.searchMarker.setIcon(_icons.address);
			_self.searchMarker.setShadow(shadow);
			_self.searchInfoWindow = new google.maps.InfoWindow({maxWidth: _self.config.maxInfoWindowWidth});
			
			// Attach event handler to the primary form.
			$('#service-areas-control-panel form').submit(_self.formSubmit);

			// Request the map data.
			$.ajax({
				url: _self.config.dataUrl,
				// TODO: Create a real error handler.
				error: function(){
				},
				success: _processData
			});
			
			// Request the map locations.
			$.ajax({
				url: _self.config.locationUrl,
				// TODO: Create a real error handler.
				error: function(){
				},
				success: _processLocations
			});
		};
		
		/**
		 * Changes the active distribution by hiding the currently visible distribution and showing
		 * the distrubution specified with the "distribution" parameter.
		 * @param {Distribution} distribution The distribution to make active.
		 * @memberOf ServiceAreas
		 * @name setActiveDistribution
		 */
		this.setActiveDistribution = function(distribution){
			if (_self.currentDistribution)
				_self.currentDistribution.hide();
				
			_self.currentDistribution = distribution;
			_self.currentDistribution.show();
			
			// Check the most recently searched location under the newly active
			// distribution -- it might have a different result.
			if (_searchHistory.length > 0)
				_self.checkLocation(_searchHistory[_searchHistory.length - 1], google.maps.GeocoderStatus.OK);
		};
		
		/**
		 * Handler for the service areas for submission. Requests a geocode using the address entered
		 * by the user, specifying {@link ServiceAreas.checkLocation} as the callback.
		 * @param {Object} e Event object. Only available if called within the context of an event.
		 * @memberOf ServiceAreas
		 * @name formSubmit
		 */
		this.formSubmit = function(e){
			_geocoder.geocode({address: $('#address').val()}, _self.checkLocation);
			
			return false;
		};
		
		/**
		 * Executed as a callback to maps.google.Geocoder.geocode or can be executed independently
		 * if a proper maps.google.GeocodeResponse object is passed as the first parameter and
		 * google.maps.GeocoderStatus.OK is passed as the second parameter.
		 * Determines whether the searched address is inside, or within the buffer distance, of
		 * the currently active distribution and displays {@link ServiceAreas.searchInfoWindow}
		 * with a message determined by the address searched and service availability.
		 * @param {google.maps.GeocoderResult[]} results An array of geocoder results.
		 * @param {google.maps.GeocoderStatus} status The status of the results.
		 * @memberOf ServiceAreas
		 * @name checkLocation
		 */
		this.checkLocation = function(results, status){
			var latlng = null, distance = 65535, message = null, text = '', distribution = null;
			
			// If the response is valid, then create a LatLng object from its coordinates.
			if (status == google.maps.GeocoderStatus.OK && results.length == 1) {
				_searchHistory.push(results);
				latlng = results[0].geometry.location;
			}
			
			if (latlng != null) {
				// Show the marker at the location.
				_self.searchMarker.setPosition(latlng);
				_self.searchMarker.setVisible(true);
				
				distribution = _self.currentDistribution;
				message = distribution.getMessageFromAddress(results[0].formatted_address);
				text = message.getOutsideMessage();
				
				// Check if if distribution contains the location and, if not, find the
				// distance to it from the distribution area.
				if (distribution.containsLatLng(latlng))
					distance = 0;
				else {
					distance = distribution.distanceToLatLng(results[0].formatted_address, latlng);
				}
				
				// Set the message depending on the distance.
				if (distance == 0)
					text = message.getInsideMessage();
				else if (distance > 0 && distance <= _self.config.bufferDistance)
					text = message.getEdgeMessage();
				
				text = '<p><strong>' + results[0].formatted_address + '</strong></p>' + text;
				
				if (_self.currentInfoWindow)
					_self.currentInfoWindow.close();
					
				_self.currentInfoWindow = _self.searchInfoWindow;
				_self.searchInfoWindow.setContent(text);
				_self.searchInfoWindow.open(_map, _self.searchMarker);
			}
		};
		
		/**
		 * Constructor.
		 */
		(function(){
			var sharedIconOptions = {
				anchor: new google.maps.Point(25, 25),
				size: new google.maps.Size(25, 25),
				origin: new google.maps.Point(0, 0)
			};
			
			_icons.shadow = new google.maps.MarkerImage('marker-flag-shadow.png',
				new google.maps.Size(27, 25),
				sharedIconOptions.origin,
				sharedIconOptions.anchor);
			
			
			_icons.store = new google.maps.MarkerImage('marker-marketplace.png', sharedIconOptions.size, sharedIconOptions.origin, sharedIconOptions.anchor);
			_icons.dc = new google.maps.MarkerImage('marker-distribution.png', sharedIconOptions.size, sharedIconOptions.origin, sharedIconOptions.anchor);
			_icons.office = new google.maps.MarkerImage('marker-offices.png', sharedIconOptions.size, sharedIconOptions.origin, sharedIconOptions.anchor);
			_icons.address = new google.maps.MarkerImage('marker-epicenter.png');
			_icons.shape = { coord: [0,0 , 25,0 , 25,25 , 0,25], type: 'poly' };
		})();
		
	})();

	/**
	 * Document ready function executed once the DOM is ready. Simply runs {@link ServiceAreas.initialize}
	 * to initialize the service areas.
	 * @name DocumentReady
	 * @memberOf _global_
	 * @see <a href="http://docs.jquery.com/How_jQuery_Works#Launching_Code_on_Document_Ready">jQuery Document Ready Documentation</a>
	 */
	$(ServiceAreas.initialize);
//})(jQuery);