<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$is_edit = ($mode === 'edit');
$form_action = $is_edit ? base_url('products/edit/' . $product['id']) : base_url('products/create');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $is_edit ? 'Edit Product' : 'Add Product'; ?> | Product Manager</title>
    <style>
        :root {
            --bg-1: #f6f8ff;
            --bg-2: #eef4ff;
            --panel: rgba(255,255,255,0.9);
            --panel-border: rgba(148, 163, 184, 0.25);
            --text: #0f172a;
            --muted: #64748b;
            --line: #dfe7f5;
            --brand: #2563eb;
            --brand-dark: #1d4ed8;
            --brand-soft: #dbeafe;
            --success-bg: #dcfce7;
            --success-text: #166534;
            --error-bg: #fee2e2;
            --error-text: #991b1b;
            --shadow: 0 24px 60px rgba(37, 99, 235, 0.12);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2.5rem 1.25rem;
            background:
                radial-gradient(circle at top left, rgba(37, 99, 235, 0.18), transparent 26%),
                radial-gradient(circle at bottom right, rgba(14, 165, 233, 0.16), transparent 28%),
                linear-gradient(135deg, var(--bg-1) 0%, var(--bg-2) 100%);
            color: var(--text);
        }

        .card {
            background: var(--panel);
            backdrop-filter: blur(10px);
            width: 100%;
            max-width: 620px;
            padding: 2rem;
            border-radius: 24px;
            border: 1px solid var(--panel-border);
            box-shadow: var(--shadow);
            height: fit-content;
        }

        .topline {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .topline h1 {
            font-size: clamp(1.7rem, 2vw, 2.1rem);
            letter-spacing: -0.04em;
        }

        .back {
            font-size: 0.85rem;
            color: var(--brand-dark);
            text-decoration: none;
            font-weight: 700;
        }

        .back:hover {
            text-decoration: underline;
        }

        .msg {
            padding: 0.8rem 0.9rem;
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

        label {
            display: block;
            font-size: 0.8rem;
            font-weight: 700;
            margin-bottom: 0.45rem;
        }

        input, textarea {
            width: 100%;
            padding: 0.85rem 0.9rem;
            border: 1px solid var(--line);
            border-radius: 12px;
            font-size: 0.96rem;
            font-family: inherit;
            color: var(--text);
            background: rgba(255,255,255,0.9);
            transition: all 0.2s ease;
        }

        textarea {
            resize: vertical;
            min-height: 110px;
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: rgba(37, 99, 235, 0.75);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.08);
            background: #fff;
        }

        .row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        button {
            margin-top: 0.5rem;
            padding: 0.9rem 1.2rem;
            background: linear-gradient(135deg, var(--brand) 0%, var(--brand-dark) 100%);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 0.96rem;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 16px 30px rgba(37, 99, 235, 0.22);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        button:hover {
            transform: translateY(-1px);
            box-shadow: 0 18px 32px rgba(29, 78, 216, 0.28);
        }

        @media (max-width: 640px) {
            .card {
                padding: 1.4rem;
            }

            .topline {
                flex-direction: column;
                align-items: flex-start;
            }

            .row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="topline">
            <h1><?= $is_edit ? 'Edit Product' : 'Add Product'; ?></h1>
            <a class="back" href="<?= base_url('products'); ?>">&larr; Back to list</a>
        </div>

        <?php if (!empty($error)): ?>
            <div class="msg error"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="msg success"><?= htmlspecialchars($success); ?></div>
        <?php endif; ?>

        <form method="post" action="<?= $form_action; ?>">
            <div>
                <label for="product_name">Product Name</label>
                <input type="text" id="product_name" name="product_name" maxlength="100" required
                       value="<?= htmlspecialchars($product['product_name'] ?? ''); ?>" autofocus>
            </div>

            <div>
                <label for="description">Description</label>
                <textarea id="description" name="description"><?= htmlspecialchars($product['description'] ?? ''); ?></textarea>
            </div>

            <div class="row">
                <div>
                    <label for="price">Price</label>
                    <input type="number" id="price" name="price" step="0.01" min="0" required
                           value="<?= htmlspecialchars($product['price'] ?? ''); ?>">
                </div>
                <div>
                    <label for="quantity">Quantity</label>
                    <input type="number" id="quantity" name="quantity" step="1" min="0" required
                           value="<?= htmlspecialchars($product['quantity'] ?? ''); ?>">
                </div>
            </div>

            <button type="submit"><?= $is_edit ? 'Save Changes' : 'Add Product'; ?></button>
        </form>
    </div>
</body>
</html>
