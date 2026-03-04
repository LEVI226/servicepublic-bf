<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Nouveau message de contact</title>
</head>

<body
    style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: #2d6a4f; color: white; padding: 20px; border-radius: 8px 8px 0 0;">
        <h1 style="margin: 0; font-size: 1.3rem;">📬 Nouveau message de contact</h1>
        <p style="margin: 5px 0 0; opacity: 0.8; font-size: 0.9rem;">Service Public — Burkina Faso</p>
    </div>

    <div
        style="background: #f9f9f9; padding: 20px; border: 1px solid #e0e0e0; border-top: none; border-radius: 0 0 8px 8px;">
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="padding: 8px 0; font-weight: bold; width: 100px; vertical-align: top;">Nom :</td>
                <td style="padding: 8px 0;">{{ $contactData['nom'] }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; font-weight: bold; vertical-align: top;">Email :</td>
                <td style="padding: 8px 0;"><a href="mailto:{{ $contactData['email'] }}">{{ $contactData['email'] }}</a>
                </td>
            </tr>
            <tr>
                <td style="padding: 8px 0; font-weight: bold; vertical-align: top;">Sujet :</td>
                <td style="padding: 8px 0;">{{ $contactData['sujet'] }}</td>
            </tr>
        </table>

        <hr style="border: none; border-top: 1px solid #ddd; margin: 15px 0;">

        <p style="font-weight: bold; margin-bottom: 5px;">Message :</p>
        <div
            style="background: white; padding: 15px; border-radius: 6px; border: 1px solid #e0e0e0; white-space: pre-wrap;">
            {{ $contactData['message'] }}</div>
    </div>

    <p style="font-size: 0.8rem; color: #999; text-align: center; margin-top: 15px;">
        Ce message a été envoyé depuis le formulaire de contact du portail Service Public BF.
    </p>
</body>

</html>