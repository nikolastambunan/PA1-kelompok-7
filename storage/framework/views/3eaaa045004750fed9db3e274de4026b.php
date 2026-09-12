<?php $__env->startSection('title', 'Biodiversitas - Geosite Danau Toba'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .hero-biodiversitas {
        background: linear-gradient(135deg, var(--blue-dark) 0%, var(--blue-medium) 100%);
        padding: 140px 0 70px;
        margin-top: 0;
        text-align: center;
        position: relative;
        overflow: hidden;
        color: white;
    }
    .hero-biodiversitas::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.05) 0%, transparent 70%);
        animation: rotateSlow 25s linear infinite;
    }
    @keyframes rotateSlow {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    .hero-biodiversitas .container { position: relative; z-index: 2; }
    .hero-biodiversitas .badge {
        display: inline-block;
        background: rgba(198, 164, 59, 0.15);
        border: 1px solid rgba(198, 164, 59, 0.3);
        color: var(--gold-light);
        padding: 6px 20px;
        border-radius: 50px;
        font-size: 0.6rem;
        letter-spacing: 3px;
        text-transform: uppercase;
        font-weight: 600;
        margin-bottom: 15px;
    }
    .hero-biodiversitas h1 {
        font-family: 'Playfair Display', serif;
        font-size: 3rem;
        font-weight: 800;
        color: white;
        margin-bottom: 12px;
    }
    .hero-biodiversitas h1 span { color: var(--gold); }
    .hero-biodiversitas p {
        color: rgba(255,255,255,0.8);
        font-size: 0.9rem;
        max-width: 600px;
        margin: 0 auto;
    }
    .hero-divider {
        width: 60px;
        height: 2px;
        background: var(--gold);
        margin: 15px auto 20px;
        border-radius: 2px;
    }
    .grid-biodiversitas {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 380px));
        gap: 30px;
        padding: 60px 0;
        justify-content: center;
    }
    .card-biodiversitas {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        transition: all 0.3s ease;
        cursor: pointer;
    }
    .card-biodiversitas:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 40px rgba(0,0,0,0.12);
    }
    .card-biodiversitas img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    .card-biodiversitas .content {
        padding: 20px;
    }
    .card-biodiversitas .content h3 {
        font-size: 1.1rem;
        font-weight: 700;
        color: #003366;
        margin-bottom: 8px;
    }
    .card-biodiversitas .content p {
        font-size: 0.85rem;
        color: #64748b;
        line-height: 1.6;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .badge-kategori {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.65rem;
        font-weight: 600;
        margin-bottom: 10px;
    }
    .badge-flora { background: #dcfce7; color: #166534; }
    .badge-fauna { background: #fef3c7; color: #92400e; }
    .badge-ekosistem { background: #dbeafe; color: #1e40af; }
    @media (max-width: 768px) {
        .grid-biodiversitas { grid-template-columns: 1fr; }
        .hero-biodiversitas { padding: 100px 0 40px; }
        .hero-biodiversitas h1 { font-size: 1.8rem; }
    }
    @media (max-width: 480px) {
        .hero-biodiversitas h1 { font-size: 1.4rem; }
    }

</style>


<div class="hero-biodiversitas">
    <div class="container">
        <div class="badge">UNESCO Global Geopark</div>
        <h1><?php echo e(__('app.biodiversity.title')); ?></h1>
        <div class="hero-divider"></div>
        <p><?php echo e(__('app.biodiversity.subtitle')); ?></p>
    </div>
</div>

<div class="container">
    <div class="grid-biodiversitas">
        <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="card-biodiversitas" onclick="window.location.href='<?php echo e(route('biodiversitas.detail', $item->slug)); ?>'">
            <?php
                $imgSrc = $item->gambar ? asset($item->gambar) : asset('image/default.jpg');
            ?>
            <img src="<?php echo e($imgSrc); ?>" alt="<?php echo e($item->nama_trans); ?>" loading="lazy" onerror="this.onerror=null; this.src='<?php echo e(asset('image/default.jpg')); ?>'">
            <div class="content">
                <span class="badge-kategori badge-<?php echo e($item->kategori); ?>">
                    <?php echo e(ucfirst($item->kategori)); ?>

                </span>
                <h3><?php echo e(Str::limit($item->nama_trans, 40)); ?></h3>
                <p><?php echo e(Str::limit(strip_tags($item->deskripsi_trans), 100)); ?></p>
                <?php if($item->lokasi): ?>
                    <p style="font-size:0.7rem; color:#94a3b8; margin-top:6px;">
                        <i class="fas fa-map-marker-alt"></i> <?php echo e($item->lokasi); ?>

                    </p>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div style="grid-column: span 3; text-align:center; padding:60px;">
            <i class="fas fa-leaf" style="font-size:3rem; color:#c6a43b; opacity:0.3;"></i>
            <p style="margin-top:16px; color:#94a3b8;"><?php echo e(__('app.common.no_data')); ?></p>
        </div>
        <?php endif; ?>
    </div>

    <?php if($data->hasPages()): ?>
    <div style="display:flex; justify-content:center; margin-bottom:40px;">
        <?php echo e($data->links()); ?>

    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Proyek akhir 1 Real\resources\views/pages/biodiversitas.blade.php ENDPATH**/ ?>