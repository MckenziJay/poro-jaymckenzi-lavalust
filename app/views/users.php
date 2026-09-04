<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users | Academic Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,400;0,6..72,500;0,6..72,600;1,6..72,400&family=IBM+Plex+Mono:wght@400;500;600&display=swap');

        :root{
            --paper:#FAF6EC;
            --paper-line:#E4DCC8;
            --navy:#1E2A44;
            --navy-soft:#4A5670;
            --gold:#A9803C;
            --sage:#6E7E63;
            --rule:#C9BE9E;
        }
        body{ font-family:'IBM Plex Mono', monospace; background:var(--navy); color:var(--navy); }
        .font-display{ font-family:'Newsreader', serif; }

        .letterhead{
            background: var(--navy);
            background-image:
                linear-gradient(180deg, rgba(255,255,255,0.04), transparent 40%);
        }

        .ledger{
            background: var(--paper);
        }

        .ledger-row{
            border-bottom: 1px solid var(--paper-line);
            transition: background-color 0.15s ease;
        }
        .ledger-row:hover{
            background-color: rgba(169,128,60,0.06);
        }

        .col-rule{
            border-left: 1px solid var(--paper-line);
        }

        .seal{
            width: 34px; height: 34px;
            border: 1.5px solid var(--gold);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
        }

        ::selection{ background: var(--gold); color: var(--paper); }
    </style>
</head>
<body class="h-screen overflow-hidden flex flex-col">

    <header class="letterhead flex-shrink-0 px-8 md:px-12 pt-8 pb-6">
        <div class="flex items-center justify-between max-w-6xl mx-auto">
            <div class="flex items-center gap-4">
                <div class="seal">
                    <i class="fa-solid fa-graduation-cap text-sm" style="color:var(--gold);"></i>
                </div>
                <div>
                    <p class="font-display italic text-sm" style="color:#C9BE9E;">Academic Portal</p>
                    <h1 class="font-display text-2xl md:text-3xl" style="color:var(--paper);">Roster of Registered Users</h1>
                </div>
            </div>
            <nav class="hidden md:flex items-center gap-8 text-xs tracking-wide" style="color:#9AA3B5;">
                <a href="#" style="color:var(--paper); border-bottom: 1px solid var(--gold);" class="pb-1">Users</a>
                <a href="#" class="hover:text-white transition-colors">Reports</a>
                <a href="#" class="hover:text-white transition-colors">Settings</a>
            </nav>
        </div>
    </header>

    <main class="ledger flex-1 overflow-y-auto px-8 md:px-12 py-8">
        <div class="max-w-6xl mx-auto">

            <div class="flex items-baseline justify-between mb-6 pb-4" style="border-bottom: 2px solid var(--navy);">
                <p class="font-display text-lg italic" style="color:var(--navy-soft);">Entered on record</p>
                <p class="text-xs" style="color:var(--sage);">
                    <?= isset($users) ? count($users) : 0 ?> user<?= (isset($users) && count($users) === 1) ? '' : 's' ?> on file
                </p>
            </div>

            <?php if (!empty($users)) : ?>

                <div class="hidden md:grid grid-cols-[3rem_1fr_1fr_1.4fr] gap-4 px-4 pb-3 text-xs" style="color:var(--sage);">
                    <span>No.</span>
                    <span>Name</span>
                    <span>Username</span>
                    <span>Email</span>
                </div>

                <div>
                    <?php foreach ($users as $i => $user) : ?>
                        <div class="ledger-row grid grid-cols-1 md:grid-cols-[3rem_1fr_1fr_1.4fr] gap-1 md:gap-4 px-4 py-4 items-baseline">
                            <span class="text-xs md:text-sm" style="color:var(--gold);">
                                <?= str_pad($i + 1, 2, '0', STR_PAD_LEFT) ?>
                            </span>
                            <span class="font-display text-base md:text-lg" style="color:var(--navy);">
                                <?= htmlspecialchars($user['firstname']) ?> <?= htmlspecialchars($user['lastname']) ?>
                                <span class="hidden md:inline text-[10px] align-middle ml-2" style="color:var(--sage);">#<?= htmlspecialchars($user['id']) ?></span>
                            </span>
                            <span class="text-xs md:text-sm" style="color:var(--navy-soft);">@<?= htmlspecialchars($user['username']) ?></span>
                            <span class="text-xs md:text-sm break-all" style="color:var(--navy-soft);"><?= htmlspecialchars($user['email']) ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>

            <?php else : ?>
                <div class="text-center py-20">
                    <p class="font-display text-xl italic mb-2" style="color:var(--navy);">No users on record</p>
                    <p class="text-xs" style="color:var(--sage);">New entries will appear here once the users table has rows.</p>
                </div>
            <?php endif; ?>

        </div>
    </main>
</body>
</html>