<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Assessment Customer - PT TELEMEDIA DINAMIKA SARANA</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.5;
            color: #000;
            background: #fff;
        }
        
        .container {
            max-width: 210mm;
            margin: 0 auto;
            padding: 10mm 20mm;
        }
        
        /* Kop Surat Resmi */
        .kop-surat {
            display: flex;
            align-items: center;
            border-bottom: 3px double #000;
            padding-bottom: 12px;
            margin-bottom: 15px;
        }
        
        .kop-logo {
            width: 80px;
            margin-right: 15px;
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
            font-size: 16pt;
            font-weight: bold;
            color: #000;
            margin-bottom: 2px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        
        .kop-text h2 {
            font-size: 11pt;
            font-weight: normal;
            color: #000;
            margin-bottom: 3px;
        }
        
        .kop-text .alamat {
            font-size: 9pt;
            color: #333;
        }
        
        .kop-spacer {
            width: 80px;
        }
        
        /* Judul Laporan */
        .judul-laporan {
            text-align: center;
            margin: 20px 0 15px 0;
        }
        
        .judul-laporan h2 {
            font-size: 13pt;
            font-weight: bold;
            margin-bottom: 3px;
            text-decoration: underline;
        }
        
        .judul-laporan p {
            font-size: 10pt;
        }
        
        /* Section Title */
        .section-title {
            font-size: 11pt;
            font-weight: bold;
            margin: 20px 0 10px 0;
            padding-bottom: 3px;
            border-bottom: 1px solid #000;
        }
        
        /* Chart Container */
        .chart-section {
            margin: 20px 0;
            page-break-inside: avoid;
            text-align: center;
        }
        
        .chart-box {
            display: inline-block;
            text-align: center;
        }
        
        .chart-box canvas {
            max-width: 100%;
            height: auto !important;
        }
        
        /* Ringkasan Table */
        .ringkasan-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            font-size: 10pt;
        }
        
        .ringkasan-table th,
        .ringkasan-table td {
            border: 1px solid #000;
            padding: 8px 10px;
            text-align: center;
        }
        
        .ringkasan-table th {
            background: #f0f0f0;
            font-weight: bold;
        }
        
        .ringkasan-table td strong {
            font-size: 13pt;
            display: block;
            margin-bottom: 2px;
        }
        
        .ringkasan-table td small {
            font-size: 9pt;
            color: #555;
        }
        
        .ringkasan-table .total-cell {
            background: #e8e8e8;
        }
        
        .ringkasan-table .sangat-puas {
            background: #d4edda;
        }
        
        .ringkasan-table .puas {
            background: #fff3cd;
        }
        
        .ringkasan-table .tidak-puas {
            background: #f8d7da;
        }
        
        /* Data Table */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9pt;
            margin-bottom: 10px;
        }
        
        .data-table th,
        .data-table td {
            border: 1px solid #000;
            padding: 6px 5px;
            text-align: left;
        }
        
        .data-table th {
            background: #f0f0f0;
            font-weight: bold;
            text-align: center;
        }
        
        .data-table tbody tr:nth-child(even) {
            background: #fafafa;
        }
        
        .data-table td.center {
            text-align: center;
        }
        /*
        .badge {
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 8pt;
            font-weight: bold;
            display: inline-block;
            border: 1px solid;
        }
        
        .badge-success {
            background: #d4edda;
            color: #155724;
            border-color: #155724;
        }
        
        .badge-warning {
            background: #fff3cd;
            color: #856404;
            border-color: #856404;
        }
        
        .badge-danger {
            background: #f8d7da;
            color: #721c24;
            border-color: #721c24;
        }
        */
        
        /* TTD Section */
        .ttd-section {
            margin-top: 30px;
            page-break-inside: avoid;
        }
        
        .ttd-table {
            width: 100%;
        }
        
        .ttd-table td {
            width: 50%;
            text-align: center;
            vertical-align: top;
            padding: 8px;
        }
        
        .ttd-box {
            text-align: center;
        }
        
        .ttd-box .tempat-tanggal {
            font-size: 10pt;
            margin-bottom: 3px;
        }
        
        .ttd-box .jabatan {
            margin-bottom: 60px;
            font-weight: bold;
            font-size: 10pt;
        }
        
        .ttd-box .nama {
            font-weight: bold;
            text-decoration: underline;
            font-size: 11pt;
            margin-bottom: 2px;
        }
        
        .ttd-box .nip {
            font-size: 9pt;
            color: #333;
        }
        
        /* Catatan Kaki */
        .catatan-kaki {
            margin-top: 20px;
            padding-top: 8px;
            border-top: 1px solid #ccc;
            font-size: 8pt;
            color: #666;
        }
        
        /* Print buttons */
        .print-buttons {
            text-align: center;
            margin-bottom: 20px;
            padding: 15px;
            background: #1a5276;
            border-radius: 8px;
        }
        
        .print-buttons button {
            padding: 10px 25px;
            margin: 0 8px;
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
            background: transparent;
            color: #fff;
            border: 2px solid #fff !important;
        }
        
        @media print {
            .print-buttons {
                display: none !important;
            }
            
            body {
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }
            
            .container {
                padding: 8mm 15mm;
            }
            
            .ringkasan-table th,
            .data-table th {
                background: #f0f0f0 !important;
                -webkit-print-color-adjust: exact;
            }
            
            .ringkasan-table .total-cell,
            .ringkasan-table .sangat-puas,
            .ringkasan-table .puas,
            .ringkasan-table .tidak-puas {
                background: #f5f5f5 !important;
            }
            
            .chart-section {
                page-break-inside: avoid;
                margin-top: 15px;
                text-align: center;
            }
            
            .chart-box canvas {
                max-width: 250px !important;
                height: auto !important;
            }
        }
        
    </style>
</head>
<body>
    <div class="container">
        <!-- Print Buttons -->
        <div class="print-buttons">
            <button class="btn-print" onclick="window.print()">Cetak / Simpan PDF</button>
            <button class="btn-back" onclick="window.close(); window.history.back();">← Kembali</button>
        </div>

        <!-- Kop Surat Resmi -->
        <div class="kop-surat">
            <div class="kop-logo">
                @php
                    $logoPath = public_path('images/logoGASNET.png');
                    $logoData = '';
                    if (file_exists($logoPath)) {
                        $logoData = 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath));
                    }
                @endphp
                @if($logoData)
                    <img src="{{ $logoData }}" alt="Logo Gasnet">
                @else
                    <img src="{{ asset('images/logoGASNET.png') }}" alt="Logo Gasnet">
                @endif
            </div>
            <div class="kop-text">
                <h1>PT TELEMEDIA DINAMIKA SARANA</h1>
                <h2>GASNET Internet Service Provider</h2>
                <p class="alamat">Jl. Raya Industri No. 123, Jakarta Pusat 10110 | Telp: (021) 1234567</p>
            </div>
            <div class="kop-spacer"></div>
        </div>

        <!-- Nomor Surat -->
        @php
        $bulanRomawi = [
            1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV',
            5 => 'V', 6 => 'VI', 7 => 'VII', 8 => 'VIII',
            9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'
        ];

        $bulan = (int) now()->format('m');
        $tahun = now()->format('Y');
        $nomorUrut = $forms->first() ? $forms->first()->id : 1;
        @endphp

        <div style="text-align: right; margin-bottom: 10px; font-size: 10pt;">
            <table style="margin-right: auto;">
                <tr>
                    <td style="padding: 2px 5px;">Nomor</td>
                    <td style="padding: 2px 5px;">:</td>
                    <td style="padding: 2px 5px; font-weight: bold;">{{ sprintf('%03d', $nomorUrut) }}/LAP-GASNET/{{ $bulanRomawi[$bulan] }}/{{ $tahun }}</td>
                </tr>
                <tr>
                    <td style="padding: 2px 5px;">Tanggal</td>
                    <td style="padding: 2px 5px;">:</td>
                    <td style="padding: 2px 5px;">{{ now()->translatedFormat('d F Y') }}</td>
                </tr>
                <tr>
                    <td style="padding: 2px 5px;">Perihal</td>
                    <td style="padding: 2px 5px;">:</td>
                    <td style="padding: 2px 5px;">Laporan Assessment Customer</td>
                </tr>
            </table>
        </div>

        <!-- Diagram Penilaian -->
        <h3 class="section-title">I. DIAGRAM PENILAIAN</h3>
        <table style="width: 100%; border: none; margin-bottom: 15px;">
            <tr>
                <td style="width: 30%; text-align: center; vertical-align: middle; border: none; padding: 10px;">
                    <canvas id="printChart" width="160" height="160"></canvas>
                </td>
                <td style="width: 70%; vertical-align: middle; padding-left: 20px; border: none;">
                    <table style="width: 100%; border-collapse: collapse; font-size: 10pt;">
                        <tr>
                            <th style="padding: 8px 10px; border: 1px solid #000; background: #f0f0f0; text-align: left; width: 50%;">Kategori</th>
                            <th style="padding: 8px 10px; border: 1px solid #000; background: #f0f0f0; text-align: center; width: 25%;">Jumlah</th>
                            <th style="padding: 8px 10px; border: 1px solid #000; background: #f0f0f0; text-align: center; width: 25%;">Persentase</th>
                        </tr>
                        <tr>
                            <td style="padding: 8px 10px; border: 1px solid #000;">
                                <span style="display: inline-block; width: 12px; height: 12px; background: #27ae60; margin-right: 8px; vertical-align: middle;"></span>
                                Sangat Puas
                            </td>
                            <td style="padding: 8px 10px; border: 1px solid #000; text-align: center;">{{ $stats['sangat_puas'] }}</td>
                            <td style="padding: 8px 10px; border: 1px solid #000; text-align: center;">{{ $stats['total'] > 0 ? number_format($stats['sangat_puas']/$stats['total']*100, 1) : 0 }}%</td>
                        </tr>
                        <tr>
                            <td style="padding: 8px 10px; border: 1px solid #000;">
                                <span style="display: inline-block; width: 12px; height: 12px; background: #f39c12; margin-right: 8px; vertical-align: middle;"></span>
                                Puas
                            </td>
                            <td style="padding: 8px 10px; border: 1px solid #000; text-align: center;">{{ $stats['puas'] }}</td>
                            <td style="padding: 8px 10px; border: 1px solid #000; text-align: center;">{{ $stats['total'] > 0 ? number_format($stats['puas']/$stats['total']*100, 1) : 0 }}%</td>
                        </tr>
                        <tr>
                            <td style="padding: 8px 10px; border: 1px solid #000;">
                                <span style="display: inline-block; width: 12px; height: 12px; background: #e74c3c; margin-right: 8px; vertical-align: middle;"></span>
                                Tidak Puas
                            </td>
                            <td style="padding: 8px 10px; border: 1px solid #000; text-align: center;">{{ $stats['tidak_puas'] }}</td>
                            <td style="padding: 8px 10px; border: 1px solid #000; text-align: center;">{{ $stats['total'] > 0 ? number_format($stats['tidak_puas']/$stats['total']*100, 1) : 0 }}%</td>
                        </tr>
                        <tr>
                            <td style="padding: 8px 10px; border: 1px solid #000; background: #f0f0f0;"><strong>Total</strong></td>
                            <td style="padding: 8px 10px; border: 1px solid #000; background: #f0f0f0; text-align: center;"><strong>{{ $stats['total'] }}</strong></td>
                            <td style="padding: 8px 10px; border: 1px solid #000; background: #f0f0f0; text-align: center;"><strong>100%</strong></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <!-- Data Detail -->
        <h3 class="section-title">II. DATA DETAIL</h3>
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 4%;">No.</th>
                    <th style="width: 10%;">Tanggal</th>
                    <th style="width: 22%;">Nama Customer</th>
                    <th style="width: 18%;">Layanan</th>
                    <th style="width: 10%;">Kapasitas</th>
                    <th style="width: 18%;">Petugas</th>
                    <th style="width: 12%;">Penilaian</th>
                </tr>
            </thead>
            <tbody>
                @forelse($forms as $index => $form)
                    <tr>
                        <td class="center">{{ $index + 1 }}</td>
                        <td class="center">{{ $form->form_date ? $form->form_date->format('d/m/Y') : '-' }}</td>
                        <td>{{ $form->customer?->customer_name ?? '-' }} ({{ $form->customer?->cid ?? '-' }})</td>
                        <td>{{ $form->customer?->layanan_service ?? '-' }}</td>
                        <td class="center">{{ $form->customer?->kapasitas_capacity ?? '-' }}</td>
                        <td>{{ $form->user->name ?? '-' }}</td>
                        <td class="center">
                            @if($form->assessment == 'sangat_puas')
                                Sangat Puas
                            @elseif($form->assessment == 'puas')
                                Puas
                            @else
                                Tidak Puas
                            @endif
                        </td>

                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 20px;">Tidak ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- TTD Section -->
        <div style="margin-top: 30px; page-break-inside: avoid;">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 50%; text-align: center; vertical-align: top;">
                    </td>
                    <td style="width: 50%; text-align: center; vertical-align: top;">
                        <p style="margin: 0 0 10px 0;">Jakarta, {{ now()->translatedFormat('d F Y') }}</p>
                    </td>
                </tr>
                <tr>
                    <td style="width: 50%; text-align: center; vertical-align: top;">
                        <p style="margin: 0;">Dibuat Oleh,</p>
                    </td>
                    <td style="width: 50%; text-align: center; vertical-align: top;">
                        <p style="margin: 0;">Mengetahui,</p>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; padding-top: 60px;">
                        <p style="margin: 0; font-weight: bold; text-decoration: underline;">{{ auth()->user()->name ?? '____________________' }}</p>
                        <p style="margin: 0; font-size: 9pt;">Staff Administrasi</p>
                    </td>
                    <td style="text-align: center; padding-top: 60px;">
                        <p style="margin: 0; font-weight: bold;">____________________</p>
                        <p style="margin: 0; font-size: 9pt;">Manager Operasional</p>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Catatan Kaki -->
        <div class="catatan-kaki">
            <p>Dokumen ini dicetak otomatis oleh Sistem Rating Customer Gasnet pada {{ now()->format('d/m/Y H:i') }} WIB</p>
        </div>
    </div>

    
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    
    <script>
        const statsData = {
            total: {{ $stats['total'] }},
            sangat_puas: {{ $stats['sangat_puas'] }},
            puas: {{ $stats['puas'] }},
            tidak_puas: {{ $stats['tidak_puas'] }}
        };
        
        const colors = {
            sangat_puas: '#27ae60',
            puas: '#f39c12',
            tidak_puas: '#e74c3c'
        };
        
        const ctx = document.getElementById('printChart').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Sangat Puas', 'Puas', 'Tidak Puas'],
                datasets: [{
                    data: [statsData.sangat_puas, statsData.puas, statsData.tidak_puas],
                    backgroundColor: [colors.sangat_puas, colors.puas, colors.tidak_puas],
                    borderWidth: 1,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: false,
                maintainAspectRatio: true,
                animation: false,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        window.onload = function() {
            setTimeout(function() { window.print(); }, 1000);
        }
    </script>
    
</body>
</html>

