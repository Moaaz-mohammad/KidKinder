<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $subjectText }}</title>
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
        .message-card {
            background: white;
            border-radius: 6px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .footer {
            margin-top: 20px;
            font-size: 0.8em;
            color: #64748b;
            text-align: center;
        }
        .attachment {
            display: flex;
            align-items: center;
            padding: 10px;
            background: white;
            border-radius: 6px;
            margin-top: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .attachment-icon {
            margin-right: 10px;
            color: #3b82f6;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3b82f6;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>{{ $subjectText }}</h2>
        <p>From {{ config('app.name') }}</p>
    </div>
    
    <div class="content">
        <div class="message-card">
            {{-- <p>Hello {{ $user->name ?? 'there' }},</p> --}}
            
            <div style="margin: 20px 0;">
                {{$bodyText}}
            </div>
            
            {{-- @if(isset($actionUrl))
              <div style="text-align: center;">
                <a href="{{ $actionUrl }}" class="btn" target="_blank">
                    {{ $actionText ?? 'View Details' }}
                </a>
              </div>
            @endif --}}
            
            <p style="margin-top: 30px;">Best regards,<br>{{ config('app.name') }} Team</p>
        </div>
        
        @if(!empty($attachmentUrl))
          <p>
            📎 <a href="{{ $attachmentUrl }}" target="_blank">Download</a>
          </p>
        @endif
        
        <div class="footer">
            <p>This message was sent to you from {{ config('app.name') }}</p>
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <p>
                <a href="{{ config('app.url') }}" style="color: #3b82f6;">Visit your profile</a> | 
                {{-- <a href="{{ config('app.url') }}/unsubscribe" style="color: #3b82f6;">Unsubscribe</a> --}}
            </p>
        </div>
    </div>
</body>
</html>