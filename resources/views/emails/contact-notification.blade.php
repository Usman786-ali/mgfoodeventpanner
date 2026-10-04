<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>New Contact Form Submission</title>
</head>

<body
    style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div
        style="background: linear-gradient(135deg, #D4A853 0%, #B8923D 100%); padding: 30px; text-align: center; border-radius: 10px 10px 0 0;">
        <h1 style="color: #000; margin: 0; font-size: 24px;">🎉 New Contact Form Submission</h1>
        <p style="color: #000; margin: 10px 0 0; opacity: 0.9;">MG Food & Event Planners</p>
    </div>

    <div style="background: #fff; padding: 30px; border: 1px solid #ddd; border-top: none;">
        <h2 style="color: #2c3e50; margin-top: 0; border-bottom: 2px solid #D4A853; padding-bottom: 10px;">
            Contact Information
        </h2>

        <table style="width: 100%; margin-bottom: 20px;">
            <tr>
                <td style="padding: 10px 0; font-weight: bold; width: 150px;">Name:</td>
                <td style="padding: 10px 0;">{{ $submission->name }}</td>
            </tr>
            <tr>
                <td style="padding: 10px 0; font-weight: bold;">Email:</td>
                <td style="padding: 10px 0;"><a href="mailto:{{ $submission->email }}"
                        style="color: #3498db;">{{ $submission->email }}</a></td>
            </tr>
            <tr>
                <td style="padding: 10px 0; font-weight: bold;">Phone:</td>
                <td style="padding: 10px 0;">{{ $submission->phone ?? 'Not provided' }}</td>
            </tr>
        </table>

        <h2 style="color: #2c3e50; border-bottom: 2px solid #D4A853; padding-bottom: 10px;">
            Event Details
        </h2>

        <table style="width: 100%; margin-bottom: 20px;">
            <tr>
                <td style="padding: 10px 0; font-weight: bold; width: 150px;">Event Type:</td>
                <td style="padding: 10px 0;">{{ $submission->event_type ?? 'Not specified' }}</td>
            </tr>
            <tr>
                <td style="padding: 10px 0; font-weight: bold;">Event Date:</td>
                <td style="padding: 10px 0;">
                    {{ $submission->event_date ? $submission->event_date->format('F d, Y') : 'Not specified' }}</td>
            </tr>
            <tr>
                <td style="padding: 10px 0; font-weight: bold;">Budget:</td>
                <td style="padding: 10px 0;">{{ $submission->budget ?? 'Not specified' }}</td>
            </tr>
            <tr>
                <td style="padding: 10px 0; font-weight: bold;">Submitted:</td>
                <td style="padding: 10px 0;">{{ $submission->created_at->format('M d, Y h:i A') }}</td>
            </tr>
        </table>

        @if($submission->message)
            <h2 style="color: #2c3e50; border-bottom: 2px solid #D4A853; padding-bottom: 10px;">
                Message
            </h2>
            <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; border-left: 4px solid #D4A853;">
                <p style="margin: 0; white-space: pre-wrap;">{{ $submission->message }}</p>
            </div>
        @endif

        <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd; text-align: center;">
            <a href="mailto:{{ $submission->email }}"
                style="display: inline-block; background: #D4A853; color: #000; padding: 12px 30px; text-decoration: none; border-radius: 25px; font-weight: bold;">
                📧 Reply to {{ $submission->name }}
            </a>
        </div>
    </div>

    <div
        style="background: #f8f9fa; padding: 20px; text-align: center; border-radius: 0 0 10px 10px; border: 1px solid #ddd; border-top: none;">
        <p style="margin: 0; color: #666; font-size: 13px;">
            This is an automated notification from your website contact form.
        </p>
        <p style="margin: 5px 0 0; color: #666; font-size: 13px;">
            © {{ date('Y') }} MG Food & Event Planners. All rights reserved.
        </p>
    </div>
</body>

</html>