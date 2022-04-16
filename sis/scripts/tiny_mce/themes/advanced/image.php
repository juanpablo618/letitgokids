<?php
require_once ('../../../../include/config.php');
if (isset($_GET['tableFk']) === FALSE)  $_GET['tableFk']    = '';
if (isset($_GET['idFk']) === FALSE)     $_GET['idFk']       = '';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>{#advanced_dlg.image_title}</title>
	<script type="text/javascript" src="../../tiny_mce_popup.js"></script>
	<script type="text/javascript" src="../../utils/mctabs.js"></script>
	<script type="text/javascript" src="../../utils/form_utils.js"></script>
	<script type="text/javascript" src="js/image.js"></script>
</head>
<body id="image" style="display: none">
<form onsubmit="ImageDialog.update();return false;" action="#">
	<div class="tabs">
		<ul>
			<li id="general_tab" class="current"><span><a href="javascript:mcTabs.displayTab('general_tab','general_panel');" onmousedown="return false;">{#advanced_dlg.image_title}</a></span></li>
		</ul>
	</div>
	<div class="panel_wrapper" style="height: 300px;">
		<div id="general_panel" class="panel current">
			<table border="0" width="100%" cellpadding="4" cellspacing="0">
				<?php
				/*
				<tr>
					<td class="nowrap"><label for="src">{#advanced_dlg.image_src}</label></td>
					<td>
						<table border="1" cellspacing="0" cellpadding="0">
							<tr>
								<td><input id="src" name="src" type="text" class="mceFocus" value="" style="width: 200px" onchange="ImageDialog.getImageData();" /></td>
								<td id="srcbrowsercontainer">&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
				<?php
				*/
				?>
				<tr>
					<td colspan="2">
						<div id="srcbrowsercontainer"></div>
						<input id="src" name="src" type="hidden" value="" />
						<input id="tableFk" name="tableFk" type="hidden" value="" />
						<input id="photo_name" name="photo_name" type="hidden" value="" />
						<iframe src="<?php echo ADMIN_URL; ?>photo-list.php?tableFk=<?php echo $_GET['tableFk']; ?>&idFk=<?php echo $_GET['idFk']; ?>" name="frmListPhotos" id="frmListPhotos" frameborder="0" border="0" width="99%" height="215" scrolling="auto" marginheight="0" marginwidth="0">Debe utilizar un Navegador que permita IFRAMES</iframe>			  
		    		</td>
				</tr>
				<tr style="display: none;">
					<td><label for="image_list">{#advanced_dlg.image_list}</label></td>
					<td><select id="image_list" name="image_list" onchange="document.getElementById('src').value=this.options[this.selectedIndex].value;document.getElementById('alt').value=this.options[this.selectedIndex].text;"></select></td>
				</tr>
				<tr style="display: none;">
					<td class="nowrap"><label for="alt">{#advanced_dlg.image_alt}</label></td>
					<td><input id="alt" name="alt" type="text" value="" style="width: 200px" /></td>
				</tr>
				<tr>
					<td class="nowrap"><label for="align">{#advanced_dlg.image_align}</label></td>
					<td>
						<select id="align" name="align" onchange="ImageDialog.updateStyle();">
							<option value="">{#not_set}</option>
							<option value="baseline">{#advanced_dlg.image_align_baseline}</option>
							<option value="top">{#advanced_dlg.image_align_top}</option>
							<option value="middle">{#advanced_dlg.image_align_middle}</option>
							<option value="bottom">{#advanced_dlg.image_align_bottom}</option>
							<option value="text-top">{#advanced_dlg.image_align_texttop}</option>
							<option value="text-bottom">{#advanced_dlg.image_align_textbottom}</option>
							<option value="left">{#advanced_dlg.image_align_left}</option>
							<option value="right">{#advanced_dlg.image_align_right}</option>
						</select>
					</td>
				</tr>
				<tr style="display: none;">
					<td class="nowrap"><label for="width">{#advanced_dlg.image_dimensions}</label></td>
					<td><input id="width" name="width" type="text" value="" size="3" maxlength="5" /> x <input id="height" name="height" type="text" value="" size="3" maxlength="5" /></td>
				</tr>
				<tr style="display: none;">
					<td class="nowrap"><label for="border">{#advanced_dlg.image_border}</label></td>
					<td><input id="border" name="border" type="text" value="" size="3" maxlength="3" onchange="ImageDialog.updateStyle();" /></td>
				</tr>
				<tr>
					<td class="nowrap"><label for="vspace">{#advanced_dlg.image_vspace}</label></td>
					<td><input id="vspace" name="vspace" type="text" value="" size="3" maxlength="3" onchange="ImageDialog.updateStyle();" /></td>
				</tr>
				<tr>
					<td class="nowrap"><label for="hspace">{#advanced_dlg.image_hspace}</label></td>
					<td><input id="hspace" name="hspace" type="text" value="" size="3" maxlength="3" onchange="ImageDialog.updateStyle();" /></td>
				</tr>
			</table>
		</div>
	</div>
	<div class="mceActionPanel">
		<div style="float: left"><input type="submit" id="insert" name="insert" value="{#insert}" /></div>
		<div style="float: right"><input type="button" id="cancel" name="cancel" value="{#cancel}" onclick="tinyMCEPopup.close();" /></div>
	</div>
</form>
</body>
</html>