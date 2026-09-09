<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Product Manager</title>
    <style>
        :root {
            --bg-1: #f6f8ff;
            --bg-2: #edf3ff;
            --panel: rgba(255, 255, 255, 0.88);
            --panel-border: rgba(148, 163, 184, 0.2);
            --brand: #2563eb;
            --brand-dark: #1d4ed8;
            --brand-soft: #dbeafe;
            --text: #0f172a;
            --muted: #64748b;
            --line: #dfe7f5;
            --success-bg: #dcfce7;
            --success-text: #166534;
            --info-bg: #dbeafe;
            --info-text: #1e40af;
            --error-bg: #fee2e2;
            --error-text: #991b1b;
            --shadow: 0 24px 60px rgba(37, 99, 235, 0.16);
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
            backdrop-filter: blur(12px);
            border: 1px solid var(--panel-border);
            border-radius: 28px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .brand-panel {
            padding: 3rem 2.5rem;
            background: linear-gradient(160deg, #0f172a 0%, #1d4ed8 55%, #2563eb 100%);
            color: #fff;
            position: relative;
        }

        .brand-panel::before {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 20% 20%, rgba(255,255,255,0.22), transparent 25%);
        }

        .brand-content {
            position: relative;
            z-index: 1;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .brand-badge {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            background: rgba(255,255,255,0.14);
            border: 1px solid rgba(255,255,255,0.25);
            display: grid;
            place-items: center;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .brand-panel h2 {
            font-size: clamp(2rem, 4vw, 2.6rem);
            line-height: 1.15;
            letter-spacing: -0.04em;
            margin-bottom: 1rem;
        }

        .brand-panel p {
            max-width: 26rem;
            color: rgba(255,255,255,0.8);
            font-size: 1rem;
            line-height: 1.7;
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
            font-size: 0.8rem;
        }

        .form-panel {
            padding: 2.75rem 2.25rem;
            background: rgba(255,255,255,0.7);
        }

        .form-wrap {
            max-width: 360px;
            margin: 0 auto;
        }

        .form-header {
            margin-bottom: 1.75rem;
        }

        .eyebrow {
            display: inline-block;
            padding: 0.35rem 0.7rem;
            border-radius: 999px;
            background: var(--brand-soft);
            color: var(--brand-dark);
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            margin-bottom: 1rem;
        }

        h1 {
            font-size: clamp(1.8rem, 2vw, 2.3rem);
            margin-bottom: 0.45rem;
            letter-spacing: -0.04em;
        }

        .subtitle {
            color: var(--muted);
            font-size: 0.97rem;
            line-height: 1.6;
        }

        .msg {
            padding: 0.82rem 0.9rem;
            border-radius: 12px;
            font-size: 0.86rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
        }

        .msg.error {
            background: var(--error-bg);
            color: var(--error-text);
            border-color: rgba(153, 27, 27, 0.08);
        }

        .msg.info {
            background: var(--info-bg);
            color: var(--info-text);
            border-color: rgba(30, 64, 175, 0.08);
        }

        .msg.success {
            background: var(--success-bg);
            color: var(--success-text);
            border-color: rgba(22, 101, 52, 0.08);
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 0.9rem;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
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

        input::placeholder {
            color: #94a3b8;
        }

        input:focus {
            outline: none;
            border-color: rgba(37, 99, 235, 0.7);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
            background: #fff;
        }

        .options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 0.25rem;
            margin-bottom: 0.25rem;
            font-size: 0.8rem;
            color: var(--muted);
        }

        .checkbox {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
        }

        .checkbox input {
            width: auto;
            margin: 0;
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
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            box-shadow: 0 18px 28px rgba(37, 99, 235, 0.25);
        }

        button:hover {
            transform: translateY(-1px);
            box-shadow: 0 18px 32px rgba(29, 78, 216, 0.3);
        }

        .footer-link {
            margin-top: 1.4rem;
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

            .brand-panel {
                padding: 2.25rem 1.5rem;
            }

            .form-panel {
                padding: 2rem 1.25rem 2.25rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-shell">
        <aside class="brand-panel">
            <div class="brand-content">
                <div>
                    <div class="brand-badge">L</div>
                    <h2>Manage your products with ease.</h2>
                    <p>Track inventory, monitor sales, and keep your operations running smoothly from one secure dashboard.</p>
                </div>

                <div class="stats">
                    <div class="stat">
                        <strong>2.4k</strong>
                        <span>Products</span>
                    </div>
                    <div class="stat">
                        <strong>98%</strong>
                        <span>Efficiency</span>
                    </div>
                </div>
            </div>
        </aside>

        <main class="form-panel">
            <div class="form-wrap">
                <div class="form-header">
                    <span class="eyebrow">Welcome</span>
                    <h1>Sign in</h1>
                    <p class="subtitle">Access your product manager dashboard.</p>
                </div>

                <?php if (!empty($denied)): ?>
                    <div class="msg info">Please log in to continue.</div>
                <?php endif; ?>
                <?php if (!empty($registered)): ?>
                    <div class="msg success">Account created. You can now log in.</div>
                <?php endif; ?>
                <?php if (!empty($error)): ?>
                    <div class="msg error"><?= htmlspecialchars($error); ?></div>
                <?php endif; ?>

                <form method="post" action="<?= base_url('login'); ?>">
                    <div class="field">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Enter your username" autocomplete="username" required autofocus>
                    </div>

                    <div class="field">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" autocomplete="current-password" required>
                    </div>

                    <div class="options">
                        <label class="checkbox"><input type="checkbox" name="remember" value="1"> Remember me</label>
                    </div>

                    <button type="submit">Log In</button>
                </form>

                <div class="footer-link">
                    Don't have an account? <a href="<?= base_url('register'); ?>">Register</a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
