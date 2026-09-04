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
        @import url('https://fonts.googleapis.com/css2?family=Special+Elite&family=Public+Sans:wght@400;500;600;700;800&family=Courier+Prime:wght@400;700&display=swap');

        :root{
            --kraft:#C7A574;
            --kraft-dark:#9C7B4C;
            --kraft-darker:#7C6039;
            --card:#F1EAD6;
            --ink:#2B2A25;
            --ink-soft:#6B6250;
            --stamp:#A63D2F;
            --forest:#2F4A3C;
        }
        body{ font-family:'Public Sans', sans-serif; background:var(--kraft-darker); color:var(--ink); }
        .font-type{ font-family:'Special Elite', monospace; }
        .font-mono{ font-family:'Courier Prime', monospace; }

        .cork-texture{
            background-color: var(--kraft);
            background-image: radial-gradient(rgba(0,0,0,0.06) 1px, transparent 1px);
            background-size: 14px 14px;
        }

        .tab-btn{
            position:relative;
            clip-path: polygon(10% 0, 90% 0, 100% 100%, 0% 100%);
        }

        .index-card{
            background: var(--card);
            background-image: repeating-linear-gradient(
                to bottom, transparent, transparent 27px,
                rgba(43,42,37,0.08) 27px, rgba(43,42,37,0.08) 28px
            );
            border: 1px solid rgba(43,42,37,0.15);
            box-shadow: 0 18px 40px -20px rgba(0,0,0,0.5), 0 2px 0 rgba(255,255,255,0.4) inset;
        }
        .index-card::before{
            content:"";
            position:absolute;
            top:0; bottom:0; left:40px;
            width:1px;
            background: rgba(166,61,47,0.35);
        }

        .stamp{
            border: 3px solid var(--stamp);
            color: var(--stamp);
            border-radius: 6px;
            mix-blend-mode: multiply;
            opacity: 0.85;
        }

        .stitch{ border-top: 2px dashed rgba(43,42,37,0.25); }
    </style>
</head>
<body class="h-screen overflow-hidden flex flex-col">
    <header class="flex-shrink-0 pt-5 px-8 cork-texture">
        <div class="flex items-end justify-between">
            <div class="flex items-end gap-1">
                <div class="tab-btn font-type text-sm px-6 pt-3 pb-3" style="background:var(--forest); color:var(--card);">
                    <i class="fa-solid fa-address-card mr-2"></i>LavaLust Registry
                </div>
                <div class="tab-btn font-type text-sm px-6 pt-3 pb-4 -mb-px" style="background:var(--card); color:var(--ink);">
                    Users
                </div>
                <a href="#" class="tab-btn font-type text-sm px-6 pt-3 pb-3 hover:pb-4 transition-all hidden md:block" style="background:rgba(241,234,214,0.35); color:var(--ink-soft);">
                    Reports
                </a>
                <a href="#" class="tab-btn font-type text-sm px-6 pt-3 pb-3 hover:pb-4 transition-all hidden lg:block" style="background:rgba(241,234,214,0.35); color:var(--ink-soft);">
                    Settings
                </a>
            </div>
        </div>
    </header>

    <main class="flex-1 overflow-y-auto cork-texture px-8 pb-10">
        <div class="rounded-b-sm rounded-tr-sm p-8 min-h-full" style="background:var(--card); box-shadow:0 -2px 0 rgba(0,0,0,0.08) inset;">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8 stitch pt-6">
                <div>
                    <p class="font-mono text-xs tracking-widest" style="color:var(--stamp);">Registrar's File</p>
                    <h2 class="font-type text-2xl mt-1" style="color:var(--ink);">User Directory</h2>
                </div>
                <p class="font-mono text-xs" style="color:var(--ink-soft);">
                    Showing <?= isset($users) ? count($users) : 0 ?> filed record<?= (isset($users) && count($users) === 1) ? '' : 's' ?>
                </p>
            </div>

            <?php if (!empty($users)) : ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php foreach ($users as $user) : ?>
                        <div class="index-card relative rounded-sm p-6 pt-7">
                            <div class="flex items-start justify-between mb-5">
                                <div class="pl-4">
                                    <p class="font-mono text-[10px] tracking-[0.15em]" style="color:var(--stamp);">User ID</p>
                                    <p class="font-mono text-base font-bold" style="color:var(--ink);">#<?= htmlspecialchars($user['id']) ?></p>
                                </div>
                                <div class="stamp font-type text-[10px] px-2 py-1 whitespace-nowrap">
                                    On File
                                </div>
                            </div>

                            <div class="pl-4 mb-5">
                                <p class="font-type text-lg leading-tight" style="color:var(--ink);">
                                    <?= htmlspecialchars($user['firstname']) ?> <?= htmlspecialchars($user['lastname']) ?>
                                </p>
                                <p class="font-mono text-xs mt-1" style="color:var(--ink-soft);">@<?= htmlspecialchars($user['username']) ?></p>
                            </div>

                            <div class="pl-4 space-y-1.5 font-mono text-xs">
                                <p><span class="inline-block w-16" style="color:var(--ink-soft);">Email:</span> <?= htmlspecialchars($user['email']) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="index-card relative rounded-sm p-8 text-center">
                    <p class="font-type text-base" style="color:var(--ink);">No records on file.</p>
                    <p class="font-mono text-xs mt-2" style="color:var(--ink-soft);">Insert rows into the users table to see them here.</p>
                </div>
            <?php endif; ?>

        </div>
    </main>
</body>
</html>