<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Product Manager</title>
    <style>
        :root {
            --bg-1: #f6f8ff;
            --bg-2: #edf4ff;
            --panel: rgba(255,255,255,0.9);
            --panel-border: rgba(148, 163, 184, 0.25);
            --brand: #2563eb;
            --brand-dark: #1d4ed8;
            --brand-soft: #dbeafe;
            --text: #0f172a;
            --muted: #64748b;
            --line: #dfe7f5;
            --shadow: 0 24px 60px rgba(37, 99, 235, 0.14);
            --error-bg: #fee2e2;
            --error-text: #991b1b;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background:
                radial-gradient(circle at top left, rgba(37, 99, 235, 0.18), transparent 28%),
                radial-gradient(circle at bottom right, rgba(14, 165, 233, 0.18), transparent 24%),
                linear-gradient(135deg, var(--bg-1) 0%, var(--bg-2) 100%);
            color: var(--text);
        }

        .login-shell {
            width: min(980px, 100%);
            display: grid;
            grid-template-columns: 1.1fr 1fr;
            background: var(--panel);
            border: 1px solid var(--panel-border);
            border-radius: 28px;
            overflow: hidden;
            box-shadow: var(--shadow);
            backdrop-filter: blur(12px);
        }

        .brand-panel {
            padding: 3rem 2.5rem;
            background: linear-gradient(160deg, #0f172a 0%, #1d4ed8 52%, #2563eb 100%);
            position: relative;
            color: #fff;
        }

        .brand-panel::before {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 20% 20%, rgba(255,255,255,0.2), transparent 24%);
        }

        .brand-content {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        .brand-badge {
            width: 52px;
            height: 52px;
            display: grid;
            place-items: center;
            border-radius: 16px;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.2);
            font-weight: 700;
            font-size: 1.45rem;
            margin-bottom: 1.5rem;
        }

        .brand-panel h2 {
            font-size: clamp(2rem, 4vw, 2.7rem);
            line-height: 1.08;
            letter-spacing: -0.05em;
            margin-bottom: 1rem;
        }

        .brand-panel p {
            color: rgba(255,255,255,0.8);
            font-size: 1rem;
            line-height: 1.7;
            max-width: 26rem;
        }

        .stats {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        .stat {
            min-width: 120px;
            padding: 0.9rem 1rem;
            border-radius: 14px;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.12);
        }

        .stat strong {
            display: block;
            font-size: 1.2rem;
            margin-bottom: 0.2rem;
        }

        .stat span {
            color: rgba(255,255,255,0.75);
            font-size: 0.78rem;
        }

        .form-panel {
            padding: 2.6rem 2.2rem;
            background: rgba(255,255,255,0.7);
        }

        .form-wrap {
            max-width: 360px;
            margin: 0 auto;
        }

        .eyebrow {
            display: inline-block;
            padding: 0.35rem 0.7rem;
            border-radius: 999px;
            background: var(--brand-soft);
            color: var(--brand-dark);
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            margin-bottom: 1rem;
        }

        h1 {
            font-size: clamp(1.9rem, 2vw, 2.3rem);
            letter-spacing: -0.04em;
            margin-bottom: 0.45rem;
        }

        .subtitle {
            color: var(--muted);
            font-size: 0.97rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .msg.error {
            padding: 0.82rem 0.9rem;
            border-radius: 12px;
            font-size: 0.86rem;
            margin-bottom: 1rem;
            background: var(--error-bg);
            color: var(--error-text);
            border: 1px solid rgba(153, 27, 27, 0.08);
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 0.9rem;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 0.45rem;
        }

        label {
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--text);
        }

        input {
            width: 100%;
            padding: 0.9rem 1rem;
            border: 1px solid var(--line);
            border-radius: 12px;
            font-size: 0.97rem;
            color: var(--text);
            background: rgba(255,255,255,0.9);
            transition: all 0.2s ease;
        }

        input:focus {
            outline: none;
            border-color: rgba(37, 99, 235, 0.7);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
            background: #fff;
        }

        button {
            width: 100%;
            padding: 0.95rem;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--brand) 0%, var(--brand-dark) 100%);
            color: #fff;
            font-size: 0.98rem;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 18px 28px rgba(37, 99, 235, 0.22);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        button:hover {
            transform: translateY(-1px);
            box-shadow: 0 20px 32px rgba(29, 78, 216, 0.28);
        }

        .footer-link {
            margin-top: 1.25rem;
            text-align: center;
            font-size: 0.9rem;
            color: var(--muted);
        }

        .footer-link a {
            color: var(--brand-dark);
            text-decoration: none;
            font-weight: 700;
        }

        .footer-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 820px) {
            .login-shell {
                grid-template-columns: 1fr;
            }

            .brand-panel,
            .form-panel {
                padding: 2rem 1.25rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-shell">
        <aside class="brand-panel">
            <div class="brand-content">
                <div>
                    <div class="brand-badge">P</div>
                    <h2>Build your account and start managing inventory.</h2>
                    <p>Track products, keep stock accurate, and manage your business from one clean dashboard.</p>
                </div>

                <div class="stats">
                    <div class="stat">
                        <strong>24/7</strong>
                        <span>Access</span>
                    </div>
                    <div class="stat">
                        <strong>Fast</strong>
                        <span>Setup</span>
                    </div>
                </div>
            </div>
        </aside>

        <main class="form-panel">
            <div class="form-wrap">
                <span class="eyebrow">Create account</span>
                <h1>Register</h1>
                <p class="subtitle">Sign up to manage products and inventory.</p>

                <?php if (!empty($error)): ?>
                    <div class="msg error"><?= htmlspecialchars($error); ?></div>
                <?php endif; ?>

                <form method="post" action="<?= base_url('register'); ?>">
                    <div class="field">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" autocomplete="username" required autofocus placeholder="Enter your username">
                    </div>

                    <div class="field">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" autocomplete="email" required placeholder="Enter your email">
                    </div>

                    <div class="field">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" autocomplete="new-password" minlength="6" required placeholder="Minimum 6 characters">
                    </div>

                    <button type="submit">Register</button>
                </form>

                <div class="footer-link">
                    Already have an account? <a href="<?= base_url('login'); ?>">Log in</a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
