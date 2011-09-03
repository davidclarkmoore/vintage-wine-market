Service Areas
=============

Summary
-------

The service areas "application" is a JavaScript app that allows users to visually see the GFS service area and to check whether their address receives distribution support. It uses the jQuery and Google Maps libraries for functionality.

Files
-----

* jquery.js -- The jQuery library version 1.3.2. The application has not been tested against 1.4.x.
* jquery.url.js -- A plugin that provides functions for easily working with URLs, specifically the page's URL.
* service-areas.css -- The CSS used to layout the interface. Can be modified as needed.
* service-areas.html -- The HTML used to structure the interface. Can be modified as needed but service-areas.js does expect most of the elements to exist and also expects the hierarchy to be the same.
* service-areas.js -- The JS file that contains of the app's logic.
* service-areas-data.xml -- An XML file that has the information needed to construct distributions, polygons, and messages.
* service-areas-locations.xml -- An XML file containing all of the DCs. Uses the same XML structure as the Store Locator on GFS.com.

Description
-----------

When the service-areas.js file is downloaded and executed by the browser, it uses jQuery to attach the ServiceAreas.initialize function to the DOM ready event. The initialize executed, called when the DOM is ready, creates the Google Maps object (google.maps.Map) and then performs two AJAX requests for the data and location XML files. When the data file is downloaded, the ServiceAreas._processData function looks at the XML and uses it to create all of the PolygonGroup, Message, and Distribution objects. When the location file is downloaded, the ServiceAreas._processLocations function executes and uses the XML to create all of the Location objects. When both files are processes, the ServiceAreas._processComplete function executes, activating a default distribution and binding a few final events.

At this point the application is ready to be used. When a user enters an address into the search field and submits the form, the ServiceAreas.formSubmit function is executed. This function performs a geocode on the address, specifying ServiceAreas.checkLocation as the callback when the geocode completes. Upon completion of the geocode, ServiceAreas.checkLocation executes and performs the bulk of the app logic.

ServiceAreas.checkLocation displays a marker at the location of the searched address. It then determines if the location is within the distribution area by calculating the distance and checking if it is within the buffer zone. If the location is inside the buffer zone, or within the distribution area itself, the address is considered to have service. Finally, an info window is displayed with a message indicatin whether service is available or not.

When the distance from the location to the distribution is calculated, it is only calculated against polygon groups with a pattern matching the formatted address (NOT the entered address, e.g. "Grand Rapids, Michigan, USA" is the formatted address while "grand rapids mi" may have been the entered address). The pattern matching is done using regex and the patterns are defined in the XML data file. This prevents areas addresses in the US that are close to the Canadian border from using the Canadian polygon group for distance calculation. If this pattern matching wasn't there, a city near the Canadian border in Washington state would be considered to have service, since it is within the buffer zone of the Canadian service area, despite being in a different country.

The messages displayed also use pattern matching. This allows searches in Canada, for example, to display a message specifically about "GFS Canada" versus just "Gordon Food Service". The message patterns are also defined in the data XML file.

Additional technical information can be found in the "documentation" folder and by viewing service-areas.js.