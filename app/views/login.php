<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign in | Product Desk</title>
    <style>
        :root {
            --bg-1: #f8fafc;
            --bg-2: #eef4ff;
            --panel: rgba(255, 255, 255, 0.88);
            --panel-border: rgba(148, 163, 184, 0.25);
            --brand: #f59e0b;
            --brand-deep: #d97706;
            --text: #111827;
            --muted: #64748b;
            --line: #dfe7f3;
            --field: #ffffff;
            --shadow: 0 24px 60px rgba(15, 23, 42, 0.12);
            --error-bg: #fee2e2;
            --error-text: #991b1b;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 24px;
            font: 16px/1.5 "Segoe UI", Arial, sans-serif;
            background:
                radial-gradient(circle at top left, rgba(245, 158, 11, 0.18), transparent 22%),
                radial-gradient(circle at bottom right, rgba(59, 130, 246, 0.18), transparent 28%),
                linear-gradient(135deg, var(--bg-1), var(--bg-2));
            color: var(--text);
        }

        .login-shell {
            width: min(100%, 980px);
            display: grid;
            grid-template-columns: 1.05fr 1fr;
            background: var(--panel);
            backdrop-filter: blur(10px);
            border: 1px solid var(--panel-border);
            border-radius: 28px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .brand-panel {
            padding: 42px 36px;
            background: linear-gradient(160deg, #111827 0%, #1f2937 35%, #4f46e5 100%);
            color: #fff;
            position: relative;
        }

        .brand-panel::before {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 20% 20%, rgba(255,255,255,0.18), transparent 24%);
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
            display: grid;
            place-items: center;
            border-radius: 16px;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.18);
            font-weight: 700;
            font-size: 1.4rem;
            margin-bottom: 20px;
        }

        .brand-panel h2 {
            margin: 0 0 14px;
            font-size: clamp(2rem, 4vw, 2.8rem);
            line-height: 1.08;
            letter-spacing: -0.05em;
        }

        .brand-panel p {
            margin: 0;
            max-width: 24rem;
            color: rgba(255,255,255,0.8);
            line-height: 1.7;
        }

        .stats {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            margin-top: 32px;
        }

        .stat {
            min-width: 120px;
            padding: 14px 16px;
            border-radius: 14px;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.12);
        }

        .stat strong {
            display: block;
            font-size: 1.2rem;
            margin-bottom: 4px;
        }

        .stat span {
            color: rgba(255,255,255,0.75);
            font-size: 0.78rem;
        }

        .form-panel {
            padding: 42px 30px;
            background: rgba(255,255,255,0.7);
        }

        .form-wrap {
            max-width: 360px;
            margin: 0 auto;
        }

        .eyebrow {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 999px;
            background: rgba(245,158,11,0.12);
            color: var(--brand-deep);
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            margin-bottom: 16px;
        }

        h1 {
            margin: 0 0 10px;
            font-size: clamp(2rem, 2vw, 2.4rem);
            letter-spacing: -0.04em;
        }

        .subtitle {
            margin: 0 0 24px;
            color: var(--muted);
            line-height: 1.6;
        }

        .error {
            padding: 12px 14px;
            border-radius: 12px;
            border: 1px solid rgba(153, 27, 27, 0.08);
            background: var(--error-bg);
            color: var(--error-text);
            margin-bottom: 18px;
            font-size: 0.89rem;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        label {
            display: block;
            font-size: 0.8rem;
            font-weight: 700;
        }

        input {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid var(--line);
            border-radius: 12px;
            background: var(--field);
            color: var(--text);
            font: inherit;
            transition: all 0.2s ease;
        }

        input:focus {
            outline: none;
            border-color: rgba(79, 70, 229, 0.7);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.12);
        }

        .options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 4px;
            font-size: 0.8rem;
            color: var(--muted);
        }

        .remember {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .remember input {
            width: auto;
            margin: 0;
        }

        button {
            width: 100%;
            margin-top: 4px;
            padding: 14px 16px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--brand) 0%, var(--brand-deep) 100%);
            color: #111827;
            cursor: pointer;
            font-weight: 700;
            font: inherit;
            box-shadow: 0 18px 30px rgba(245, 158, 11, 0.25);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        button:hover {
            transform: translateY(-1px);
            box-shadow: 0 20px 32px rgba(217, 119, 6, 0.28);
        }

        @media (max-width: 820px) {
            .login-shell {
                grid-template-columns: 1fr;
            }

            .brand-panel,
            .form-panel {
                padding: 28px 22px;
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
                    <h2>Keep your inventory moving.</h2>
                    <p>Track products, manage stock, and monitor performance from one streamlined workspace.</p>
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
                <span class="eyebrow">Welcome</span>
                <h1>Product Desk</h1>
                <p class="subtitle">Sign in to manage the product inventory.</p>

                <?php if (!empty($error)): ?><div class="error" role="alert"><?= htmlspecialchars($error); ?></div><?php endif; ?>

                <form method="post" action="<?= site_url('login'); ?>">
                    <div class="field">
                        <label for="username">Username</label>
                        <input id="username" name="username" type="text" required autocomplete="username" placeholder="Enter your username">
                    </div>

                    <div class="field">
                        <label for="password">Password</label>
                        <input id="password" name="password" type="password" required autocomplete="current-password" placeholder="Enter your password">
                    </div>

                    <div class="options">
                        <label class="remember"><input type="checkbox" name="remember" value="1"> Remember me</label>
                    </div>

                    <button type="submit">Sign in</button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>