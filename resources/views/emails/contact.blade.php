<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Contact Message</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #3b82f6;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 0 0 8px 8px;
        }
        .detail-card {
            background: white;
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .label {
            font-weight: 600;
            color: #64748b;
            display: inline-block;
            width: 100px;
        }
        .footer {
            margin-top: 20px;
            font-size: 0.8em;
            color: #64748b;
            text-align: center;
        }
    </style>
</head>
    <body>
        <div class="header">
            <h2>New Contact Message</h2>
            <p>From School Website</p>
        </div>
        
        <div class="content">
            <div class="detail-card">
                <div><span class="label">Name:</span> {{ $contact['name'] }}</div>
                <div><span class="label">Email:</span> <a href="mailto:{{ $contact['email'] }}">{{ $contact['email'] }}</a></div>
                {{-- <div><span class="label">Phone:</span> {{ $contactData['phone'] ?? 'Not provided' }}</div> --}}
            </div>
            
            <div class="detail-card">
                <div><span class="label">Subject:</span> {{ $contact['subject'] }}</div>
                <div><span class="label">Received:</span> {{ now()->format('F j, Y g:i a') }}</div>
            </div>
            
            <div class="detail-card">
                <div class="label">Message:</div>
                <p>{{ $contact['message'] }}</p>
            </div>
            
            <div class="footer">
                <p>This message was sent from the contact form on {{ config('app.name') }}</p>
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            </div>
        </div>
    </body>
</html>