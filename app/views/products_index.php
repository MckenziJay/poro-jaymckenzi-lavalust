<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$is_admin = (($_SESSION['role'] ?? null) === 'admin');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products | Product Manager</title>
    <style>
        :root {
            --bg-1: #f6f8ff;
            --bg-2: #eef4ff;
            --panel: rgba(255,255,255,0.9);
            --panel-border: rgba(148, 163, 184, 0.22);
            --text: #0f172a;
            --muted: #64748b;
            --line: #e2e8f0;
            --brand: #2563eb;
            --brand-dark: #1d4ed8;
            --brand-soft: #dbeafe;
            --success-bg: #dcfce7;
            --success-text: #166534;
            --error-bg: #fee2e2;
            --error-text: #991b1b;
            --warning-bg: #fef3c7;
            --warning-text: #92400e;
            --shadow: 0 24px 60px rgba(37, 99, 235, 0.12);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            min-height: 100vh;
            padding: 2.5rem 1.25rem;
            background:
                radial-gradient(circle at top left, rgba(37, 99, 235, 0.14), transparent 24%),
                linear-gradient(135deg, var(--bg-1) 0%, var(--bg-2) 100%);
            color: var(--text);
        }

        .wrap {
            max-width: 1180px;
            margin: 0 auto;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            padding: 1rem 0;
        }

        h1 {
            font-size: clamp(1.8rem, 2.5vw, 2.4rem);
            letter-spacing: -0.04em;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .user-tag {
            color: var(--muted);
            font-size: 0.85rem;
        }

        .user-tag strong {
            color: var(--text);
        }

        .role-badge {
            display: inline-block;
            background: var(--warning-bg);
            color: var(--warning-text);
            padding: 0.2rem 0.55rem;
            border-radius: 999px;
            font-size: 0.72rem;
            font-weight: 700;
            margin-left: 0.45rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.65rem 1rem;
            border-radius: 10px;
            font-size: 0.86rem;
            font-weight: 700;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn:hover { transform: translateY(-1px); }

        .btn-primary {
            background: linear-gradient(135deg, var(--brand) 0%, var(--brand-dark) 100%);
            color: #fff;
            box-shadow: 0 12px 24px rgba(37, 99, 235, 0.18);
        }

        .btn-muted {
            background: #edf2f7;
            color: var(--text);
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: #fff;
        }

        .btn-sm {
            padding: 0.5rem 0.75rem;
            font-size: 0.78rem;
        }

        .msg {
            padding: 0.82rem 0.95rem;
            border-radius: 12px;
            font-size: 0.86rem;
            margin-bottom: 1.2rem;
            border: 1px solid transparent;
        }

        .msg.success {
            background: var(--success-bg);
            color: var(--success-text);
            border-color: rgba(22, 101, 52, 0.08);
        }

        .msg.error {
            background: var(--error-bg);
            color: var(--error-text);
            border-color: rgba(153, 27, 27, 0.08);
        }

        .panel {
            background: var(--panel);
            border: 1px solid var(--panel-border);
            border-radius: 22px;
            box-shadow: var(--shadow);
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 0.95rem 1rem;
            text-align: left;
            font-size: 0.92rem;
        }

        th {
            background: linear-gradient(135deg, var(--brand) 0%, var(--brand-dark) 100%);
            color: #fff;
            font-weight: 700;
        }

        tbody tr:nth-child(even) {
            background: rgba(248, 250, 252, 0.8);
        }

        tbody tr:hover {
            background: rgba(219, 234, 254, 0.6);
        }

        td {
            border-bottom: 1px solid var(--line);
            color: var(--text);
            vertical-align: top;
        }

        td.desc {
            max-width: 260px;
            color: #475569;
            line-height: 1.5;
        }

        td.numeric {
            text-align: right;
            white-space: nowrap;
            font-weight: 600;
        }

        .row-actions {
            display: flex;
            gap: 0.5rem;
            align-items: center;
            flex-wrap: wrap;
        }

        form.inline {
            display: inline;
        }

        .empty {
            padding: 2.2rem 1rem;
            text-align: center;
            color: var(--muted);
            background: #fff;
        }

        @media (max-width: 768px) {
            .topbar {
                align-items: flex-start;
            }

            .actions {
                width: 100%;
            }

            .panel {
                overflow-x: auto;
            }

            table {
                min-width: 760px;
            }
        }
    </style>
</head>
<body>
<div class="wrap">
    <div class="topbar">
        <h1>Products</h1>
        <div class="actions">
            <span class="user-tag">
                Signed in as <strong><?= htmlspecialchars($_SESSION['username'] ?? ''); ?></strong>
                <?php if (!$is_admin): ?>
                    <span class="role-badge">view only</span>
                <?php endif; ?>
            </span>
            <?php if ($is_admin): ?>
                <a class="btn btn-primary" href="<?= base_url('products/create'); ?>">+ Add Product</a>
            <?php endif; ?>
            <a class="btn btn-muted" href="<?= base_url('logout'); ?>">Logout</a>
        </div>
    </div>

    <?php if (!empty($success)): ?>
        <div class="msg success"><?= htmlspecialchars($success); ?></div>
    <?php endif; ?>
    <?php if (!empty($error)): ?>
        <div class="msg error"><?= htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <div class="panel">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Created</th>
                    <?php if ($is_admin): ?><th>Actions</th><?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td>#<?= htmlspecialchars($product['id']); ?></td>
                            <td><?= htmlspecialchars($product['product_name']); ?></td>
                            <td class="desc"><?= htmlspecialchars($product['description']); ?></td>
                            <td class="numeric">₱<?= number_format((float) $product['price'], 2); ?></td>
                            <td class="numeric"><?= htmlspecialchars($product['quantity']); ?></td>
                            <td><?= htmlspecialchars($product['created_at'] ?? ''); ?></td>
                            <?php if ($is_admin): ?>
                            <td>
                                <div class="row-actions">
                                    <a class="btn btn-muted btn-sm" href="<?= base_url('products/edit/' . $product['id']); ?>">Edit</a>
                                    <form class="inline" method="post" action="<?= base_url('products/delete/' . $product['id']); ?>" onsubmit="return confirm('Delete this product?');">
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="<?= $is_admin ? 7 : 6; ?>" class="empty">
                        <?= $is_admin ? 'No products yet. Click "Add Product" to create one.' : 'No products yet.'; ?>
                    </td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
