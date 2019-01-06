<?php
/**
 * @var Calendar_Invite_Calendar_Data $calendar_invite_data
 * @see \Calendar_Invite::add_ical_mail_parts()
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="telephone=no" name="format-detection">
    <title><?php echo get_bloginfo('name') ?></title>
    <!--[if (mso 16)]>
    <style type="text/css">
        a {text-decoration: none;}
    </style>
    <![endif]-->
    <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]-->
    <!--[if !mso]>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i" rel="stylesheet">
    <!--<![endif]-->
    <style type="text/css">
        body {
            width: 100%;
            font-family: 'open sans', 'helvetica neue', helvetica, arial, sans-serif;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            padding: 0;
            Margin: 0;
        }
        @media only screen and (max-width:600px) {p, ul li, ol li, a { font-size:16px!important; line-height:150%!important } h1 { font-size:30px!important; text-align:center; line-height:120%!important } h2 { font-size:26px!important; text-align:center; line-height:120%!important } h3 { font-size:20px!important; text-align:center; line-height:120%!important } h1 a { font-size:30px!important } h2 a { font-size:26px!important } h3 a { font-size:20px!important } .es-menu td a { font-size:16px!important } .es-header-body p, .es-header-body ul li, .es-header-body ol li, .es-header-body a { font-size:16px!important } .es-footer-body p, .es-footer-body ul li, .es-footer-body ol li, .es-footer-body a { font-size:16px!important } .es-infoblock p, .es-infoblock ul li, .es-infoblock ol li, .es-infoblock a { font-size:12px!important } *[class="gmail-fix"] { display:none!important } .es-m-txt-c, .es-m-txt-c h1, .es-m-txt-c h2, .es-m-txt-c h3 { text-align:center!important } .es-m-txt-r, .es-m-txt-r h1, .es-m-txt-r h2, .es-m-txt-r h3 { text-align:right!important } .es-m-txt-l, .es-m-txt-l h1, .es-m-txt-l h2, .es-m-txt-l h3 { text-align:left!important } .es-m-txt-r img, .es-m-txt-c img, .es-m-txt-l img { display:inline!important } .es-button-border { display:block!important } .es-button { font-size:20px!important; display:block!important; border-width:15px 25px 15px 25px!important } .es-btn-fw { border-width:10px 0!important; text-align:center!important } .es-adaptive table, .es-btn-fw, .es-btn-fw-brdr, .es-left, .es-right { width:100%!important } .es-content table, .es-header table, .es-footer table, .es-content, .es-footer, .es-header { width:100%!important; max-width:600px!important } .es-adapt-td { display:block!important; width:100%!important } .adapt-img { width:100%!important; height:auto!important } .es-m-p0 { padding:0px!important } .es-m-p0r { padding-right:0px!important } .es-m-p0l { padding-left:0px!important } .es-m-p0t { padding-top:0px!important } .es-m-p0b { padding-bottom:0!important } .es-m-p20b { padding-bottom:20px!important } .es-mobile-hidden, .es-hidden { display:none!important } .es-desk-hidden { display:table-row!important; width:auto!important; overflow:visible!important; float:none!important; max-height:inherit!important; line-height:inherit!important } .es-desk-menu-hidden { display:table-cell!important } table.es-table-not-adapt, .esd-block-html table { width:auto!important } table.es-social { display:inline-block!important } table.es-social td { display:inline-block!important } }
        #outlook a {
            padding: 0px;
        }
        .es-button {
            mso-style-priority: 100px!important;
            text-decoration: none!important;
        }
        a[x-apple-data-detectors] {
            color: inherit!important;
            text-decoration: none!important;
            font-size: inherit!important;
            font-family: inherit!important;
            font-weight: inherit!important;
            line-height: inherit!important;
        }
        .es-desk-hidden {
            display: none;
            float: left;
            overflow: hidden;
            width: 0;
            max-height: 0;
            line-height: 0;
            mso-hide: all;
        }
        table {
            mso-table-lspace:   0;
            mso-table-rspace:   0;
            padding:            0;
            border-spacing:     0;
            border-collapse:    collapse;
        }
        .es-content {
            text-align:         center;
            table-layout:       fixed !important;
            width:              100%;
        }
        .es-content-body {
            background-color:   transparent;
            width:              640px;
            text-align: center;
        }
        .es-wrapper {
            Margin:                 0;
            width:                  100%;
            height:                 100%;
            background-repeat:      repeat;
            background-position:    center top;
        }
        .es-left {
            float: left;
            text-align: left;
        }
        .es-event-date {
            border-collapse: separate;
        }
        .es-right {
            float: right;
            text-align: right;
        }
        .es-footer {
            table-layout:           fixed !important;
            width:                  100%;
            background-color:       transparent;
            background-repeat:      repeat;
            background-position:    center top;
            text-align:             center;
        }
        .es-footer-body {
            background-color:   transparent;
            width:              640px;
            text-align:         center;
        }
        .es-wrapper-color {
            background-color:   #F6F6F6;
        }
        .es-wrapper > tr, .es-content > tr, .es-content-body > tr, .es-footer > tr, .es-footer-body > tr {
            border-collapse:    collapse;
        }
    </style>
</head>
<body>
<div class="es-wrapper-color">
    <!--[if gte mso 9]>
    <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
        <v:fill type="tile" color="#f6f6f6"></v:fill>
    </v:background>
    <![endif]-->
    <table class="es-wrapper">
        <tr>
            <td valign="top" style="padding:0;Margin:0;">
                <table class="es-content">
                    <tr>
                    </tr>
                    <tr>
                        <td align="center" style="padding:0;Margin:0;">
                            <table class="es-content-body" cellspacing="0" cellpadding="0" align="center">
                                <tr>
                                    <td align="left" style="Margin:0;padding-top:15px;padding-bottom:15px;padding-left:20px;padding-right:20px;">
                                        <!--[if mso]><table width="600" cellpadding="0" cellspacing="0"><tr><td width="290" valign="top"><![endif]-->
                                        <table class="es-left" cellspacing="0" cellpadding="0" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left;">
                                            <tr style="border-collapse:collapse;">
                                                <td width="290" align="left" style="padding:0;Margin:0;">
                                                    <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                        <tr style="border-collapse:collapse;">
                                                            <td class="es-infoblock es-m-txt-c" align="left" style="padding:0;Margin:0;line-height:14px;font-size:12px;color:#CCCCCC;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:12px;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:14px;color:#CCCCCC;"><br></p> </td>
                                                        </tr>
                                                    </table> </td>
                                            </tr>
                                        </table>
                                        <!--[if mso]></td><td width="20"></td><td width="290" valign="top"><![endif]-->
                                        <table class="es-right">
                                            <tr style="border-collapse:collapse;">
                                                <td width="290" align="left" style="padding:0;Margin:0;">
                                                    <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                        <tr style="border-collapse:collapse;">
                                                            <td class="es-infoblock es-m-txt-c" align="right" style="padding:0;Margin:0;line-height:14px;font-size:12px;color:#CCCCCC;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:12px;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;line-height:14px;color:#CCCCCC;"><br></p> </td>
                                                        </tr>
                                                    </table> </td>
                                            </tr>
                                        </table>
                                        <!--[if mso]></td></tr></table><![endif]--> </td>
                                </tr>
                            </table> </td>
                    </tr>
                </table>
                <table class="es-content">
                    <tr>
                        <td style="padding:0;Margin:0;background-color:#3D4C6B;background-size:cover;" bgcolor="#3d4c6b" align="center">
                            <table class="es-content-body" width="640" bgcolor="#f6f6f6" align="center">
                                <tr style="border-collapse:collapse;">
                                    <td align="left" style="padding:0;Margin:0;padding-top:10px;padding-left:20px;padding-right:20px;">
                                        <table width="100%">
                                            <tr style="border-collapse:collapse;">
                                                <td width="600" valign="top" align="center" style="padding:0;Margin:0;">
                                                    <table width="100%">
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;padding-bottom:25px;padding-top:40px;"> <img src="<?php echo plugin_dir_url( dirname(__FILE__)) . "/images/90451519716512050.png" ?>" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" alt="Logo" title="Logo" width="50"></td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;padding-top:25px;"> <h2 style="Margin:0;line-height:48px;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;font-size:40px;font-style:normal;font-weight:bold;color:#FFFFFF;">Event Invitation</h2></td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;padding-bottom:30px;"> <h2 style="Margin:0;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;font-style:normal;font-weight:bold;color:#FFFFFF;"><?php echo htmlentities($calendar_invite_data->get_subject()) ?></h2></td>
                                                        </tr>
                                                    </table> </td>
                                            </tr>
                                        </table> </td>
                                </tr>
                                <tr style="border-collapse:collapse;">
                                    <td align="left" style="padding:0;Margin:0;padding-left:40px;padding-right:40px;">
                                        <!--[if mso]><table width="560"><tr><td width="182" valign="top"><![endif]-->
                                        <table class="es-left">
                                            <tr style="border-collapse:collapse;">
                                                <td class="es-m-p0r" width="162" align="center" style="padding:0;Margin:0;">
                                                    <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;padding-top:10px;padding-left:20px;padding-right:20px;">
                                                                <table width="100%" height="100%">
                                                                    <tr style="border-collapse:collapse;">
                                                                        <td style="padding:0;Margin:0px;border-bottom:1px solid transparent;background:none;height:1px;width:100%;margin:0px;"></td>
                                                                    </tr>
                                                                </table> </td>
                                                        </tr>
                                                    </table> </td>
                                                <td class="es-hidden" width="20" style="padding:0;Margin:0;"></td>
                                            </tr>
                                        </table>
                                        <!--[if mso]></td><td width="196" valign="top"><![endif]-->
                                        <table class="es-left">
                                            <tr style="border-collapse:collapse;">
                                                <td width="196" align="center" style="padding:0;Margin:0;">
                                                    <table class="es-event-date" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;border-radius:3px;background-color:#FFFFFF;" width="100%" bgcolor="#ffffff">
                                                        <tr style="border-collapse:collapse;">
                                                            <td style="padding:0;Margin:0;padding-bottom:5px;padding-top:10px;border-radius:3px 3px 0 0;" bgcolor="#ff0000" align="center"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:1.3em;letter-spacing:0.2em;font-family:sans-serif, helvetica, arial;line-height:21px;color:#FFFFFF;"><?php echo $calendar_invite_data->get_event_start()->format( 'F') ?></p> </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" style="Margin:0;padding-top: 1px;padding-left:15px;padding-right:15px;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family: sans-serif, 'open sans', 'helvetica neue', helvetica, arial, sans-serif;color:#444444;"><?php echo $calendar_invite_data->get_event_start()->format( 'D') ?></p> </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" style="Margin:0;padding-top:15px;/* padding-bottom:15px; */padding-left:15px;padding-right:15px;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:48px;font-family: sans-serif, 'open sans', 'helvetica neue', helvetica, arial, sans-serif;line-height:72px;color:#444444;"><?php echo $calendar_invite_data->get_event_start()->format( 'j') ?></p> </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" style="Margin:0;padding-top: 2px;padding-bottom:15px;/* padding-left:15px; *//* padding-right:15px; */"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size: 1em;font-family: sans-serif, 'open sans', 'helvetica neue', helvetica, arial, sans-serif;/* line-height:72px; */color:#444444;"><?php echo $calendar_invite_data->get_event_start()->format( 'G:i') . ' - ' . $calendar_invite_data->get_event_end()->format( 'G:i') ?></p> </td>
                                                        </tr>
                                                    </table> </td>
                                            </tr>
                                        </table>
                                        <!--[if mso]></td><td width="20"></td><td width="162" valign="top"><![endif]-->
                                        <table class="es-right">
                                            <tr style="border-collapse:collapse;">
                                                <td width="162" align="center" style="padding:0;Margin:0;">
                                                    <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;padding-top:10px;padding-left:20px;padding-right:20px;">
                                                                <table width="100%" height="100%">
                                                                    <tr style="border-collapse:collapse;">
                                                                        <td style="padding:0;Margin:0px;border-bottom:1px solid transparent;background:none;height:1px;width:100%;margin:0px;"></td>
                                                                    </tr>
                                                                </table> </td>
                                                        </tr>
                                                    </table> </td>
                                            </tr>
                                        </table>
                                        <!--[if mso]></td></tr></table><![endif]--> </td>
                                </tr>
                                <tr style="border-collapse:collapse;">
                                    <td align="left" style="Margin:0;padding-bottom:15px;padding-top:20px;padding-left:20px;padding-right:20px;">
                                        <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tr style="border-collapse:collapse;">
                                                <td width="600" valign="top" align="center" style="padding:0;Margin:0;">
                                                    <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;padding-top:15px;padding-bottom:20px;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;line-height:24px;color:#B7BDC9;"><?php echo 'Where: ' . htmlentities($calendar_invite_data->get_place()) ?></p> </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;padding-top:5px;padding-bottom:40px;"> <span class="es-button-border" style="border-style:solid;border-color:#75B6C9;background:#75B6C9;border-width:1px;display:inline-block;border-radius:28px;width:auto;"> <?php echo htmlentities($calendar_invite_data->get_description()) ?> </span> </td>
                                                        </tr>
                                                    </table> </td>
                                            </tr>
                                        </table> </td>
                                </tr>
                            </table> </td>
                    </tr>
                </table>
                <table class="es-footer">
                    <tr>
                        <td align="center" style="padding:0;Margin:0;">
                            <table class="es-footer-body">
                                <tr>
                                    <td align="left" style="Margin:0;padding-left:20px;padding-right:20px;padding-top:40px;padding-bottom:40px;">
                                        <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tr style="border-collapse:collapse;">
                                                <td width="600" valign="top" align="center" style="padding:0;Margin:0;">
                                                    <table width="100%">
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;padding-bottom:5px;"> <img src="<?php echo plugin_dir_url( dirname(__FILE__)) . "/images/55891519718168286.png" ?>" alt="Logo" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" title="Logo" width="35"></td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;padding-top:15px;padding-bottom:15px;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;line-height:21px;color:#999999;"></p></td>
                                                        </tr>
                                                    </table> </td>
                                            </tr>
                                        </table> </td>
                                </tr>
                            </table> </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
</body>
</html>