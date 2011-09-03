<?php
// $Id: node.tpl.php,v 1.5 2007/10/11 09:51:29 goba Exp $
?>
<form action="" method="post" name="fvf" id="fvf">
    <table width="100%" border="0">
      <tr>
        <td id="content"><?php print locale('Price per pound of Raw Potatoes'); ?></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="pricesource" size="10" /></td>
        <td id="content"><?php print locale(' $/LB'); ?></td>
      </tr>
      <tr bgcolor="#F7F7FF">
        <td id="content"><?php print locale('Price per pound of GFS&reg; Frozen Fried Potatoes'); ?></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="frysource" size="10" /></td>
        <td id="content"><?php print locale(' $/LB'); ?></td>
      </tr>
      <tr>
        <td id="content"><?php print locale('Wage/hour (Of employee preparing the food)'); ?></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="wagesource" size="10" /></td>
        <td id="content"></td>
      </tr>
      <tr bgcolor="#F7F7FF">
        <td id="content"><?php print locale('Price of Oil per litre'); ?></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="oilsource" size="10" /></td>
        <td id="content"><?php print locale(' $/lt'); ?></td>
      </tr>
      <tr>
        <td id="content"><?php print locale('Servings per day per store'); ?></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="sourcesevings" size="10" /></td>
        <td id="content"></td>
      </tr>
      <tr bgcolor="#F7F7FF">
        <td id="content"><?php print locale('Number of stores'); ?></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="storessource" size="10" /></td>
        <td id="content"></td>
      </tr>
      <tr>
        <td id="content"></td>
        <td id="content" align="center"><input id="inputbox" type="button" name="button" value="<?php print locale('Calculate'); ?>" onclick="update();" /></td>
        <td id="content"></td>
      </tr>
    </table>
<br />
<br />
    <table width="100%" border="0">
      <tr>
        <td id="header2" colspan="3"><?php print locale('Fresh Cut Frozen Fried Potatoes'); ?></td>
        <td id="header2" colspan="2"><?php print locale('GFS&reg; Frozen Fried Potatoes'); ?></td>
      </tr>
      <tr>
        <td id="content" colspan="3"><b><?php print locale('Product'); ?></b></td>
        <td id="content" colspan="2"><b><?php print locale('Product'); ?></b></td>
      </tr>
      <tr bgcolor="#F7F7FF">
        <td id="content"><?php print locale('Price Per Pound'); ?></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="priceperpound" size="10" /></td>
        <td id="content" width="30"></td>
        <td id="content"><?php print locale('Price Per Pound'); ?></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="priceperpound2" size="10" /></td>
      </tr>
      <tr>
        <td id="content"><?php print locale('Raw Product Weight LBs.'); ?></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="weight" size="10" /></td>
        <td id="content" width="30"></td>
        <td id="content"><?php print locale('Raw Product Weight LBs.'); ?></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="weight2" size="10" /></td>
      </tr>
      <tr bgcolor="#F7F7FF">
        <td id="content"><?php print locale('Raw Product Cost $'); ?></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="rawcost" size="10" /></td>
        <td id="content" width="30"></td>
        <td id="content"><?php print locale('Raw Product Cost'); ?></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="rawcost2" size="10" /></td>
      </tr>
      <tr>
        <td id="content" colspan="3"><b><?php print locale('Labour'); ?></b></td>
        <td id="content" colspan="2"><b><?php print locale('Labour'); ?></b></td>
      </tr>
      <tr bgcolor="#F7F7FF">
        <td id="content"><?php print locale('Labour Wage/hr'); ?></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="wage" size="10" /></td>
        <td id="content" width="30"></td>
        <td id="content"><?php print locale('Labour Wage/hr'); ?></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="wage2" size="10" /></td>
      </tr>
      <tr>
        <td id="content"><?php print locale('Hours/LB of Raw Product'); ?></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="exodus" size="10" /></td>
        <td id="content" width="30"></td>
        <td id="content"><?php print locale('Hours/LB of Raw Product'); ?></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="exodus2" size="10" /></td>
      </tr>
      <tr bgcolor="#F7F7FF">
        <td id="content"><?php print locale('Labour Cost/LB of Raw Product'); ?></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="laborperhour" size="10" /></td>
        <td id="content" width="30"></td>
        <td id="content"><?php print locale('Labour Cost/LB of Raw Product'); ?></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="laborperhour2" size="10" /></td>
      </tr>
      <tr>
        <td id="content"><?php print locale('Pounds of Raw Product'); ?></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="poundsoproducts" size="10" /></td>
        <td id="content" width="30"></td>
        <td id="content"><?php print locale('Pounds of Raw Product'); ?></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="poundsoproducts2" size="10" /></td>
      </tr>
      <tr bgcolor="#F7F7FF">
        <td id="content"><?php print locale('Labour Cost'); ?></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="laborcostst" size="10" /></td>
        <td id="content" width="30"></td>
        <td id="content"><?php print locale('Labour Cost'); ?></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="laborcostst2" size="10" /></td>
      </tr>
      <tr>
        <td id="content" colspan="3"><b><?php print locale('Oil'); ?></b></td>
        <td id="content" colspan="2"><b><?php print locale('Oil'); ?></b></td>
      </tr>
      <tr bgcolor="#F7F7FF">
        <td id="content"><?php print locale('Price of Oil/lt'); ?></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="oilprice" size="10" /></td>
        <td id="content" width="30"></td>
        <td id="content"><?php print locale('Price of Oil/lt'); ?></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="oilprice2" size="10" /></td>
      </tr>
      <tr>
        <td id="content"><?php print locale("lt's of Oil/LB of Raw Product"); ?></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="oilperproduct" size="10" /></td>
        <td id="content" width="30"></td>
        <td id="content"><?php print locale("lt's of Oil/LB of Raw Product"); ?></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="oilperproduct2" size="10" /></td>
      </tr>
      <tr bgcolor="#F7F7FF">
        <td id="content"><?php print locale('Oil Cost/LB of Raw Product'); ?></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="oilcostperoundprod" size="10" /></td>
        <td id="content" width="30"></td>
        <td id="content"><?php print locale('Oil Cost/LB of Raw Product'); ?></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="oilcostperoundprod2" size="10" /></td>
      </tr>
      <tr>
        <td id="content"><?php print locale('Pounds of Raw Product'); ?></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="poundsopie" size="10" /></td>
        <td id="content" width="30"></td>
        <td id="content"><?php print locale('Pounds of Raw Product'); ?></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="poundsopie2" size="10" /></td>
      </tr>
      <tr bgcolor="#F7F7FF">
        <td id="content"><?php print locale('Oil Cost'); ?></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="totoilcost" size="10" /></td>
        <td id="content" width="30"></td>
        <td id="content"><?php print locale('Oil Cost'); ?></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="totoilcost2" size="10" /></td>
      </tr>
      <tr>
        <td id="content" colspan="3"><b><?php print locale('Totals'); ?></b></td>
        <td id="content" colspan="2"><b><?php print locale('Totals'); ?></b></td>
      </tr>
      <tr bgcolor="#F7F7FF">
        <td id="content"><?php print locale('Total Cost'); ?></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="totcosts" size="10" /></td>
        <td id="content" width="30"></td>
        <td id="content"><?php print locale('Total Cost'); ?></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="totcosts2" size="10" /></td>
      </tr>
      <tr>
        <td id="content"><?php print locale('Pounds of Raw Product'); ?></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="raw" size="10" /></td>
        <td id="content" width="30"></td>
        <td id="content"><?php print locale('Pounds of Raw Product'); ?></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="raw2" size="10" /></td>
      </tr>
      <tr bgcolor="#F7F7FF">
        <td id="content"><?php print locale('Total Cost/LB of Raw Product'); ?></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="costperlbrawtot" size="10" /></td>
        <td id="content" width="30"></td>
        <td id="content"><?php print locale('Total Cost/LB of Raw Product'); ?></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="costperlbrawtot2" size="10" /></td>
      </tr>
      <tr>
        <td id="content"><?php print locale('Servings/LB of Raw Product'); ?></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="servingsperpound" size="10" /></td>
        <td id="content" width="30"></td>
        <td id="content"><?php print locale('Servings/LB of Raw Product'); ?></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="servingsperpound2" size="10" /></td>
      </tr>
      <tr bgcolor="#F7F7FF">
        <td id="content"><?php print locale('Cost per Serving'); ?></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="costsperservings" size="10" /></td>
        <td id="content" width="30"></td>
        <td id="content"><?php print locale('Cost per Serving'); ?></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="costsperservings2" size="10" /></td>
      </tr>
      <tr>
        <td id="header2" colspan="5"><?php print locale('Savings with GFS&reg; Product'); ?></td>
      </tr>
      <tr>
        <td id="content"></td>
        <td id="content"></td>
        <td id="subheader" colspan="2" bgcolor="#F7F7FF"><b><?php print locale('Advantage per Serving'); ?></b></td>
        <td id="content" bgcolor="#F7F7FF" align="center"><input id="inputbox" type="text" name="advan" size="10" /></td>
      </tr>
      <tr>
        <td id="content"></td>
        <td id="content"></td>
        <td id="subheader" colspan="2"><b><?php print locale('Servings per day per store'); ?></b><b></b></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="servingstotperday" size="10" /></td>
      </tr>
      <tr>
        <td id="content"></td>
        <td id="content"></td>
        <td id="subheader" colspan="2" bgcolor="#F7F7FF"><b><?php print locale('Savings per day per store'); ?></b></td>
        <td id="content" bgcolor="#F7F7FF" align="center"><input id="inputbox" type="text" name="savingperstoreperday" size="10" /></td>
      </tr>
      <tr>
        <td id="content"></td>
        <td id="content"></td>
        <td id="subheader" colspan="2"><b><?php print locale('Days per year'); ?></b></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="days" size="10" /></td>
      </tr>
      <tr>
        <td id="content"></td>
        <td id="content"></td>
        <td id="subheader" colspan="2" bgcolor="#F7F7FF"><b><?php print locale('Savings per year per store'); ?></b></td>
        <td id="content" bgcolor="#F7F7FF" align="center"><input id="inputbox" type="text" name="savingserperyearperstore" size="10" /></td>
      </tr>
      <tr>
        <td id="content"></td>
        <td id="content"></td>
        <td id="subheader" colspan="2"><b><?php print locale('Number of stores'); ?></b></td>
        <td id="content" align="center"><input id="inputbox" type="text" name="stoersnumber" size="10" /></td>
      </tr>
      <tr>
        <td id="content"></td>
        <td id="content"></td>
        <td id="title" colspan="2" bgcolor="#F7F7FF"><b><?php print locale('TOTAL SAVINGS PER YEAR'); ?></b></td>
        <td id="content" bgcolor="#F7F7FF" align="center" nowrap="nowrap"><b>$</b>
            <input id="inputbox" type="text" name="wow" size="10" /></td>
      </tr>
    </table>
</form>