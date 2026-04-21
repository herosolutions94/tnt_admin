<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>{{ $content['subject'] }}</title>
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');
        .im {
           color: #000000 !important;
        }
    </style>
</head>

<body style="background: #f8f9ff; margin: 0; padding: 20px 0;">
    <table
        style="width: 600px;background: #fff; color: #2f2a49; height: 574px; margin: 0 auto; border-spacing: 0; font-size: 14px; font-family: 'Poppins', sans-serif;">
        <tbody>
            <tr>
                <td style="padding: 0;">
                    <table
                        style="width: 100%; background: #fff; box-shadow: 0 1rem 2rem -0.3rem rgb(47 42 73 / 5%); border-spacing: 0; border-radius: 4px;">
                        <tbody>
                            <tr>
                                <td style="padding: 20px; box-sizing: border-box;">
                                    <table style="width: 100%; border-spacing: 0;">
                                        <tbody>
                                            <tr>
                                                <td style="padding: 0;">
                                                    <p style="display: block; width: 200px; margin: 0 auto;">
                                                        <img src="{{ get_site_image_src('images', $site_settings->site_email_logo) }}"
                                                            alt="{{ $site_settings->site_name }} Logo"
                                                            style="display: block; width: 100%;">
                                                    </p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 100%; padding: 20px; box-sizing: border-box;">
                                    <table style="width: 100%; border-spacing: 0;">
                                        <tbody>
                                            <tr>
                                                <td style="padding: 0;">
                                                    <p>Hello {{ $content['email_to_name'] }},</p>
                                                    <p>Your password has been successfully changed. You can now log in with your new password.</p>
                                                    <p>If you did not request this change, please contact us immediately. Please note we will never ask for your password over email or phone.</p>

                                                </td>
                                            </tr>

                                            <tr>
                                                <td style="padding: 0;">
                                                    <p>This email comes from an automated and non-monitored email. If you have any questions or concerns contact us at <a href="mailto:support@veerra.com">support@veerra.com</a>.</p>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>

        </tbody>
    </table>
</body>

</html>
