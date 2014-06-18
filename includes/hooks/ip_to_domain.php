<?php
/**
Sets the service's domain to their dedicated IP (mainly for VPSs) for WHMCS
Version 1.0 by KuJoe (JMD.cc)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
**/

function update_domain($vars) {
	if ($vars['params']['producttype'] = "server") {
		$serviceid = $vars['params']['serviceid'];
		$result = mysql_query("SELECT dedicatedip FROM tblhosting WHERE id=$serviceid");
		$rdedip = mysql_fetch_row($result);
		$dedip = $rdedip[0];
		if (empty($dedip)) {
			#do nothing yet
		} else {
			update_query("tblhosting", array("domain"=>$dedip), array("id" => $serviceid));
		}
	}
}

add_hook("AfterModuleCreate",1,"update_domain");
?>
