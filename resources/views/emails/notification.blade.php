<!DOCTYPE html>
<html lang="en" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
  <meta charset="utf-8">
  <meta name="x-apple-disable-message-reformatting">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="format-detection" content="telephone=no, date=no, address=no, email=no">
  <meta name="color-scheme" content="light dark">
  <meta name="supported-color-schemes" content="light dark">
  <!--[if mso]>
  <noscript>
    <xml>
      <o:OfficeDocumentSettings xmlns:o="urn:schemas-microsoft-com:office:office">
        <o:PixelsPerInch>96</o:PixelsPerInch>
      </o:OfficeDocumentSettings>
    </xml>
  </noscript>
  <style>
    td,th,div,p,a,h1,h2,h3,h4,h5,h6 {font-family: "Segoe UI", sans-serif; mso-line-height-rule: exactly;}
  </style>
  <![endif]-->
  <title>Confirm your signup</title>
  <style>
    .hover-bg-blue-500:hover {
      background-color: #3b82f6 !important;
    }
    .hover-text-white:hover {
      color: #fff !important;
    }
    @media (prefers-color-scheme: dark) {
      .dark-bg-blue-700 {
        background-color: #1d4ed8 !important;
      }
      .dark-text-gray-100 {
        color: #EAEFF4 !important;
      }
      .dark-hover-bg-blue-600:hover {
        background-color: #2563eb !important;
      }
      .dark-hover-text-blue-100:hover {
        color: #dbeafe !important;
      }
    }
    @media (max-width: 600px) {
      .sm-w-full {
        width: 100% !important;
      }
      .sm-px-8 {
        padding-left: 32px !important;
        padding-right: 32px !important;
      }
      .sm-px-6 {
        padding-left: 24px !important;
        padding-right: 24px !important;
      }
      .sm-pb-3 {
        padding-bottom: 12px !important;
      }
    }
  </style>
</head>
<body style="word-break: break-word; -webkit-font-smoothing: antialiased; margin: 0; width: 100%; background-color: #EAEFF4; padding: 0">
  <div role="article" aria-roledescription="email" aria-label="Confirm your signup" lang="en">
    <table style="width: 100%; font-family: ui-sans-serif, system-ui, -apple-system, 'Segoe UI', sans-serif" cellpadding="0" cellspacing="0" role="presentation">
      <tr>
        <td align="center" style="background-color: #EAEFF4; padding-top: 24px; padding-bottom: 24px">
          <table class="sm-w-full" style="width: 600px" cellpadding="0" cellspacing="0" role="presentation">
            <tr>
              <td class="sm-pb-3" style="padding-bottom: 8px; padding-top: 24px; text-align: center">
                <h1 style="font-size: 24px; color: #0C1016">
                  {{ $title }}
                </h1>
              </td>
            </tr>
            <tr>
              <td align="center" class="sm-px-8" style="border-radius: 8px; background-color: #fff; padding: 48px; text-align: center; color: #272E38; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1)">
                <table style="width: 100%" cellpadding="0" cellspacing="0" role="presentation">
                  <tr>
                    <td class="sm-px-6" >
                      {{ $body }}
                    </td>
                  </tr>
                  <tr>
                    <td class="sm-px-6" style="padding-top: 20px">
                        @if ($actionUrl)
                        <a href="{{ $actionUrl }}" class="dark-bg-blue-700 dark-text-gray-100 hover-bg-blue-500 hover-text-white dark-hover-bg-blue-600 dark-hover-text-blue-100" style="text-decoration: none; display: inline-block; height: 36px; border-radius: 4px; background-color: #2563eb; padding-left: 24px; padding-right: 24px; font-size: 14px; font-weight: 600; text-transform: uppercase; line-height: 36px; color: #fff">
                        <!--[if mso]><i style="letter-spacing: 24px; mso-font-width: -100%; mso-text-raise: 26pt;">&nbsp;</i><![endif]-->
                        <span style="mso-text-raise: 13pt">{{ $actionText }}</span>
                        <!--[if mso]><i style="letter-spacing: 24px; mso-font-width: -100%;">&nbsp;</i><![endif]-->
                        </a>
                        @endif
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </div>
</body>
</html>
