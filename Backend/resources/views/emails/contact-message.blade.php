<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Contact Message</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #0b101e;
            color: #e2e8f0;
            padding: 24px;
            margin: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #0f172a;
            border: 1px solid #1e293b;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.5);
        }
        .header {
            background: linear-gradient(135deg, #06b6d4, #10b981);
            padding: 24px;
            text-align: center;
        }
        .header h1 {
            color: #050505;
            margin: 0;
            font-size: 20px;
            font-weight: 800;
            letter-spacing: 0.5px;
        }
        .body {
            padding: 28px;
        }
        .field {
            margin-bottom: 16px;
        }
        .label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #94a3b8;
            margin-bottom: 4px;
            font-weight: 600;
        }
        .value {
            font-size: 14px;
            color: #ffffff;
            font-weight: 500;
        }
        .message-box {
            background-color: #020617;
            border: 1px solid #334155;
            border-radius: 12px;
            padding: 16px;
            margin-top: 16px;
            line-height: 1.6;
            color: #cbd5e1;
            font-size: 14px;
            white-space: pre-wrap;
        }
        .footer {
            padding: 16px 28px;
            background-color: #080c17;
            border-top: 1px solid #1e293b;
            font-size: 12px;
            color: #64748b;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🚀 New Portfolio Inquiry Received</h1>
        </div>
        <div class="body">
            <div class="field">
                <div class="label">Sender Name</div>
                <div class="value">{{ $contactMessage->sender_name }}</div>
            </div>
            <div class="field">
                <div class="label">Sender Email</div>
                <div class="value">
                    <a href="mailto:{{ $contactMessage->sender_email }}" style="color: #38bdf8; text-decoration: none;">
                        {{ $contactMessage->sender_email }}
                    </a>
                </div>
            </div>
            <div class="field">
                <div class="label">Project Type</div>
                <div class="value">{{ $contactMessage->project_type ?? 'General Inquiry' }}</div>
            </div>
            @if($contactMessage->budget_range)
            <div class="field">
                <div class="label">Budget Range</div>
                <div class="value" style="color: #34d399;">{{ $contactMessage->budget_range }}</div>
            </div>
            @endif
            <div class="field">
                <div class="label">Message</div>
                <div class="message-box">{{ $contactMessage->message }}</div>
            </div>
        </div>
        <div class="footer">
            Received on {{ $contactMessage->created_at->format('M d, Y - H:i T') }} | IP: {{ $contactMessage->ip_address ?? 'N/A' }}
        </div>
    </div>
</body>
</html>
