<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($form->customer->customer_name); ?> - Formulir Kunjungan <?php echo e($form->form_date ? $form->form_date->format('d-m-Y') : now()->format('d-m-Y')); ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            line-height: 1.4;
            color: #333;
            background: #fff;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        
        /* Kop Surat dengan Logo */
        .kop-surat {
            display: flex;
            align-items: center;
            padding-bottom: 12px;
            margin-bottom: 15px;
            border-bottom: 3px solid #1a5276;
        }
        
        .kop-logo {
            width: 130px;
            margin-right: 20px;
        }
        
        .kop-logo img {
            width: 100%;
            height: auto;
        }
        
        .kop-text {
            flex: 1;
            text-align: center;
        }
        
        .kop-text h1 {
            font-size: 22px;
            font-weight: bold;
            color: #1a5276;
            margin-bottom: 2px;
            letter-spacing: 3px;
        }
        
        .kop-text h2 {
            font-size: 14px;
            font-weight: bold;
            color: #2874a6;
            margin-bottom: 5px;
        }
        
        .kop-text .alamat {
            font-size: 9px;
            color: #555;
            margin-bottom: 2px;
        }
        
        .kop-spacer {
            width: 130px;
        }
        
        /* Judul Form */
        .form-title {
            text-align: center;
            padding: 10px;
            margin-bottom: 15px;
            background: linear-gradient(135deg, #1a5276 0%, #2874a6 100%);
            color: #fff;
            border-radius: 5px;
        }
        
        .form-title h3 {
            font-size: 14px;
            font-weight: bold;
            letter-spacing: 1px;
        }
        
        .section {
            margin-bottom: 12px;
        }
        
        .section-title {
            font-size: 11px;
            font-weight: bold;
            background: #1a5276;
            color: #fff;
            padding: 5px 10px;
            margin-bottom: 8px;
            border-radius: 3px;
        }
        
        .section-title.olive {
            background: #27ae60;
        }
        
        table.info-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        table.info-table td {
            padding: 3px 8px;
            vertical-align: top;
            font-size: 10px;
        }
        
        table.info-table td.label {
            width: 130px;
            font-weight: bold;
            color: #1a5276;
        }
        
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }
        
        table.data-table th,
        table.data-table td {
            border: 1px solid #1a5276;
            padding: 6px;
            text-align: left;
            font-size: 10px;
        }
        
        table.data-table th {
            background: #1a5276;
            color: #fff;
            font-weight: bold;
        }
        
        .checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            padding: 8px;
        }
        
        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 4px;
        }
        
        .checkbox {
            width: 12px;
            height: 12px;
            border: 1px solid #1a5276;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 9px;
            border-radius: 2px;
        }
        
        .checkbox.checked {
            background: #1a5276;
            color: #fff;
        }
        
        .text-area {
            border: 1px solid #bdc3c7;
            min-height: 50px;
            padding: 6px;
            margin: 5px 0;
            border-radius: 3px;
            background: #f9f9f9;
            font-size: 10px;
        }
        
        .assessment-section {
            padding: 8px;
            background: #f8f9fa;
            border-radius: 5px;
            border: 1px solid #dee2e6;
        }
        
        .assessment-options {
            display: flex;
            gap: 25px;
            justify-content: center;
            margin-top: 8px;
        }
        
        .assessment-item {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 5px 10px;
            border-radius: 5px;
        }
        
        .assessment-item.active-tidak-puas {
            background: #fadbd8;
        }
        
        .assessment-item.active-puas {
            background: #fcf3cf;
        }
        
        .assessment-item.active-sangat-puas {
            background: #d5f5e3;
        }
        
        .signature-table {
            page-break-inside: avoid;
        }
        
        .signature-box {
            border: 1px solid #1a5276;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
        }
        
        .signature-box .title {
            font-weight: bold;
            margin-bottom: 3px;
            color: #333;
            font-size: 10px;
        }
        
        .signature-box .company {
            color: #1a5276;
            font-weight: bold;
            margin-bottom: 8px;
            font-size: 10px;
        }
        
        .footer {
            margin-top: 15px;
            padding-top: 10px;
            border-top: 2px solid #1a5276;
            text-align: center;
            font-size: 8px;
            color: #666;
        }
        
        .footer img {
            height: 20px;
            margin-bottom: 3px;
        }
        
        .print-buttons {
            text-align: center;
            margin-bottom: 20px;
            padding: 15px;
            background: linear-gradient(135deg, #1a5276 0%, #2874a6 100%);
            border-radius: 8px;
        }
        
        .print-buttons button {
            padding: 10px 25px;
            margin: 0 5px;
            font-size: 13px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            font-weight: bold;
        }
        
        .btn-print {
            background: #fff;
            color: #1a5276;
        }
        
        .btn-back {
            background: rgba(255,255,255,0.2);
            color: #fff;
            border: 2px solid #fff !important;
        }
        
        @media print {
            @page {
                margin: 10mm;
                size: A4;
            }
            
            .print-buttons {
                display: none !important;
            }
            
            body {
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
                font-size: 10px;
                margin: 0;
                padding: 0;
            }
            
            .container {
                padding: 0;
                margin: 0;
            }
            
            .kop-logo {
                width: 140px;
                margin-right: 20px;
            }
            
            .section {
                page-break-inside: avoid;
                margin-bottom: 8px;
            }
            
            .kop-surat {
                padding-bottom: 10px;
                margin-bottom: 12px;
            }
            
            .form-title {
                margin-bottom: 10px;
                padding: 8px;
            }
            
            .section-title {
                padding: 4px 8px;
                margin-bottom: 5px;
            }
            
            table.info-table td {
                padding: 2px 5px;
            }
            
            table.data-table th,
            table.data-table td {
                padding: 4px;
            }
            
            .text-area {
                min-height: 35px;
                padding: 4px;
            }
            
            .footer {
                margin-top: 10px;
                padding-top: 8px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Print Buttons -->
        <div class="print-buttons">
            <button class="btn-print" onclick="window.print()">
                Cetak / Simpan PDF
            </button>
            <button class="btn-back" onclick="window.close(); window.history.back();">
                ← Kembali
            </button>
        </div>

        <!-- Kop Surat dengan Logo -->
        <div class="kop-surat">
            <div class="kop-logo">
                <?php
                    $logoPath = public_path('images/logoGASNET.png');
                    $logoData = '';
                    if (file_exists($logoPath)) {
                        $logoData = 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath));
                    }
                ?>
                <?php if($logoData): ?>
                    <img src="<?php echo e($logoData); ?>" alt="Logo Gasnet">
                <?php else: ?>
                    <img src="<?php echo e(asset('images/logoGASNET.png')); ?>" alt="Logo Gasnet">
                <?php endif; ?>
            </div>
            <div class="kop-text">
                <h1>PT TELEMEDIA DINAMIKA SARANA</h1>
                <h2>GASNET Internet Service Provider</h2>
                <p class="alamat">Jl. Raya Industri No. 123, Jakarta Pusat 10110 | Telp: (021) 1234567</p>
            </div>
            <div class="kop-spacer"></div>
        </div>

        <!-- Nomor Surat -->
         <?php
        $bulanRomawi = [
            1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV',
            5 => 'V', 6 => 'VI', 7 => 'VII', 8 => 'VIII',
            9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'
        ];

        $bulan = $form->form_date
            ? (int) $form->form_date->format('m')
            : (int) now()->format('m');

        $tahun = $form->form_date
            ? $form->form_date->format('Y')
            : now()->format('Y');
        ?>

        <div style="text-align: right; margin-bottom: 10px; font-size: 10px;">
            <table style="margin-right: auto;">
                <tr>
                    <td style="padding: 2px 5px;">Nomor</td>
                    <td style="padding: 2px 5px;">:</td>
                    <td style="padding: 2px 5px; font-weight: bold;">
                        <?php echo e(sprintf('%03d', $form->id)); ?>/OSC-GASNET/<?php echo e($bulanRomawi[$bulan]); ?>/<?php echo e($tahun); ?>

                    </td>
                </tr>

                <tr>
                    <td style="padding: 2px 5px;">Tanggal</td>
                    <td style="padding: 2px 5px;">:</td>
                    <td style="padding: 2px 5px;"><?php echo e($form->form_date ? $form->form_date->translatedFormat('d F Y') : now()->translatedFormat('d F Y')); ?></td>
                </tr>
                <tr>
                    <td style="padding: 2px 5px;">Perihal</td>
                    <td style="padding: 2px 5px;">:</td>
                    <td style="padding: 2px 5px;">Form Onsite Customer</td>
                </tr>
            </table>
        </div>
        <!-- Customer Detail -->
        <div class="section">
            <div class="section-title">CUSTOMER DETAIL</div>
            <table class="info-table">
                <tr>
                    <td class="label">Customer Name</td>
                    <td>: <?php echo e($form->customer->customer_name); ?></td>
                </tr>
                <tr>
                    <td class="label">CID</td>
                    <td>: <?php echo e($form->customer->cid ?? '-'); ?></td>
                </tr>
                <tr>
                    <td class="label">Address</td>
                    <td>: <?php echo e($form->customer->alamat_lengkap); ?>, <?php echo e($form->customer->kelurahan); ?>, <?php echo e($form->customer->kecamatan); ?>, <?php echo e($form->customer->kota_kabupaten); ?>, <?php echo e($form->customer->provinsi); ?></td>
                </tr>
                <tr>
                    <td class="label">Layanan / Service</td>
                    <td>: <?php echo e($form->customer->layanan_service); ?></td>
                </tr>
                <tr>
                    <td class="label">Kapasitas / Capacity</td>
                    <td>: <?php echo e($form->customer->kapasitas_capacity); ?></td>
                </tr>
                <tr>
                    <td class="label">No. Telp (PIC)</td>
                    <td>: <?php echo e($form->customer->no_telp_pic); ?></td>
                </tr>
                <tr>
                    <td class="label">E-mail</td>
                    <td>: <?php echo e($form->customer->email); ?></td>
                </tr>
            </table>
        </div>

        <!-- Maintenance Device -->
        <div class="section">
            <div class="section-title">MAINTENANCE DEVICE</div>
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 20%;">Device Name</th>
                        <th style="width: 20%;">Serial Number</th>
                        <th style="width: 25%;">Foto Produk</th>
                        <th style="width: 30%;">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $form->maintenanceDevices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $device): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td style="text-align: center;"><?php echo e($index + 1); ?></td>
                        <td><?php echo e($device->device_name); ?></td>
                        <td><?php echo e($device->serial_number); ?></td>
                        <td style="text-align: center;">
                            <?php if($device->product_photo): ?>
                                <?php
                                    $photoPath = storage_path('app/public/' . $device->product_photo);
                                    $photoData = '';
                                    if (file_exists($photoPath)) {
                                        $extension = pathinfo($photoPath, PATHINFO_EXTENSION);
                                        $mimeType = $extension === 'png' ? 'image/png' : 'image/jpeg';
                                        $photoData = 'data:' . $mimeType . ';base64,' . base64_encode(file_get_contents($photoPath));
                                    }
                                ?>
                                <?php if($photoData): ?>
                                    <img src="<?php echo e($photoData); ?>" alt="Foto Produk" style="max-width: 80px; max-height: 60px;">
                                <?php else: ?>
                                    <span style="color: #999;">-</span>
                                <?php endif; ?>
                            <?php else: ?>
                                <span style="color: #999;">-</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($device->keterangan ?? '-'); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td style="text-align: center;">1</td>
                        <td>-</td>
                        <td>-</td>
                        <td style="text-align: center;">-</td>
                        <td>-</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Technical Detail -->
        <div class="section">
            <div class="section-title olive">TECHNICAL DETAIL</div>
            
            <table class="info-table">
                <tr>
                    <td class="label">Activity</td>
                    <td>
                        <div class="checkbox-group">
                            <div class="checkbox-item">
                                <div class="checkbox <?php echo e($form->activity_survey ? 'checked' : ''); ?>"><?php echo e($form->activity_survey ? '✓' : ''); ?></div>
                                <span>Survey</span>
                            </div>
                            <div class="checkbox-item">
                                <div class="checkbox <?php echo e($form->activity_activation ? 'checked' : ''); ?>"><?php echo e($form->activity_activation ? '✓' : ''); ?></div>
                                <span>Activation</span>
                            </div>
                            <div class="checkbox-item">
                                <div class="checkbox <?php echo e($form->activity_upgrade ? 'checked' : ''); ?>"><?php echo e($form->activity_upgrade ? '✓' : ''); ?></div>
                                <span>Upgrade</span>
                            </div>
                            <div class="checkbox-item">
                                <div class="checkbox <?php echo e($form->activity_downgrade ? 'checked' : ''); ?>"><?php echo e($form->activity_downgrade ? '✓' : ''); ?></div>
                                <span>Downgrade</span>
                            </div>
                            <div class="checkbox-item">
                                <div class="checkbox <?php echo e($form->activity_troubleshoot ? 'checked' : ''); ?>"><?php echo e($form->activity_troubleshoot ? '✓' : ''); ?></div>
                                <span>Troubleshoot</span>
                            </div>
                            <div class="checkbox-item">
                                <div class="checkbox <?php echo e($form->activity_preventive_maintenance ? 'checked' : ''); ?>"><?php echo e($form->activity_preventive_maintenance ? '✓' : ''); ?></div>
                                <span>Preventive Maintenance</span>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            
            <table class="info-table" style="margin-top: 8px;">
                <tr>
                    <td class="label">Complaint</td>
                    <td>:</td>
                </tr>
            </table>
            <div class="text-area"><?php echo e($form->complaint ?: '-'); ?></div>
            
            <table class="info-table">
                <tr>
                    <td class="label">Action</td>
                    <td>:</td>
                </tr>
            </table>
            <div class="text-area"><?php echo e($form->action ?: '-'); ?></div>
        </div>

        <!-- Assessment -->
        <div class="section">
            <div class="assessment-section">
                <table class="info-table">
                    <tr>
                        <td class="label"><strong>Assessment</strong></td>
                        <td>
                            <div class="assessment-options">
                                <div class="assessment-item <?php echo e($form->assessment == 'tidak_puas' ? 'active-tidak-puas' : ''); ?>">
                                    <div class="checkbox <?php echo e($form->assessment == 'tidak_puas' ? 'checked' : ''); ?>"><?php echo e($form->assessment == 'tidak_puas' ? '✓' : ''); ?></div>
                                    <span>Tidak Puas</span>
                                </div>
                                <div class="assessment-item <?php echo e($form->assessment == 'puas' ? 'active-puas' : ''); ?>">
                                    <div class="checkbox <?php echo e($form->assessment == 'puas' ? 'checked' : ''); ?>"><?php echo e($form->assessment == 'puas' ? '✓' : ''); ?></div>
                                    <span>Puas</span>
                                </div>
                                <div class="assessment-item <?php echo e($form->assessment == 'sangat_puas' ? 'active-sangat-puas' : ''); ?>">
                                    <div class="checkbox <?php echo e($form->assessment == 'sangat_puas' ? 'checked' : ''); ?>"><?php echo e($form->assessment == 'sangat_puas' ? '✓' : ''); ?></div>
                                    <span>Sangat Puas</span>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Date and Location -->
        <div style="text-align: right; margin: 10px 0 8px 0; font-style: italic; font-weight: bold; color: #1a5276; font-size: 10px;">
            <?php echo e($form->location); ?>, <?php echo e($form->form_date ? $form->form_date->format('d F Y') : ''); ?>

        </div>

        <!-- Signature -->
        <table class="signature-table" style="width: 100%; border-collapse: collapse; page-break-inside: avoid;">
            <tr>
                <td style="width: 50%; padding: 5px; vertical-align: top;">
                    <div class="signature-box">
                        <div class="title">Pihak Pertama,</div>
                        <div class="company">PT TELEMEDIA DINAMIKA SARANA</div>
                        <div style="height: 80px; display: flex; align-items: center; justify-content: center;">
                            <?php if($form->signature_first_party): ?>
                                <img src="<?php echo e($form->signature_first_party); ?>" alt="Signature" style="max-height: 70px; max-width: 180px;">
                            <?php endif; ?>
                        </div>
                        <div style="border-top: 1px solid #1a5276; padding-top: 5px; margin-top: 5px; font-size: 10px;">
                            <strong>( <?php echo e($form->first_party_name ?: '________________'); ?> )</strong>
                        </div>
                    </div>
                </td>
                <td style="width: 50%; padding: 5px; vertical-align: top;">
                    <div class="signature-box">
                        <div class="title">Pihak Kedua,</div>
                        <div style="height: 14px;">&nbsp;</div>
                        <div style="height: 80px; display: flex; align-items: center; justify-content: center;">
                            <?php if($form->signature_second_party): ?>
                                <img src="<?php echo e($form->signature_second_party); ?>" alt="Signature" style="max-height: 70px; max-width: 180px;">
                            <?php endif; ?>
                        </div>
                        <div style="border-top: 1px solid #1a5276; padding-top: 5px; margin-top: 5px; font-size: 10px;">
                            <strong>( <?php echo e($form->second_party_name ?: '________________'); ?> )</strong>
                        </div>
                    </div>
                </td>
            </tr>
        </table>

        <!-- Footer -->
        <div class="footer">
            <p>Dokumen ini dicetak dari Sistem Rating Customer Gasnet | © <?php echo e(date('Y')); ?> All Rights Reserved</p>
        </div>
    </div>

    <script>
        // Set document title untuk nama file PDF saat save
        (function() {
            var customerName = <?php echo json_encode($form->customer->customer_name, 15, 512) ?>;
            var formDate = '<?php echo e($form->form_date ? $form->form_date->format("d-m-Y") : now()->format("d-m-Y")); ?>';
            var pdfTitle = customerName + ' - Formulir ' + formDate;
            document.title = pdfTitle;
        })();
        
        <?php if(request('print')): ?>
            window.onload = function() {
                setTimeout(function() {
                    window.print();
                }, 500);
            }
        <?php endif; ?>
    </script>
</body>
</html>
<?php /**PATH C:\Users\Jihan Saniyya\ratingPGN-app\resources\views/forms/pdf.blade.php ENDPATH**/ ?>