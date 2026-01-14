<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Assessment - PT TELEMEDIA DINAMIKA SARANA</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.6;
            color: #000;
            background: #fff;
        }
        
        .container {
            max-width: 210mm;
            margin: 0 auto;
            padding: 15mm 20mm;
        }
        
        /* Kop Surat dengan Logo */
        .kop-surat {
            display: flex;
            align-items: center;
            border-bottom: 4px solid #1a5276;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        
        .kop-logo {
            width: 150px;
            margin-right: 25px;
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
            font-size: 22pt;
            font-weight: bold;
            color: #1a5276;
            margin-bottom: 3px;
            letter-spacing: 4px;
        }
        
        .kop-text h2 {
            font-size: 14pt;
            font-weight: bold;
            color: #2874a6;
            margin-bottom: 8px;
        }
        
        .kop-text .alamat {
            font-size: 10pt;
            color: #333;
            margin-bottom: 2px;
        }
        
        .kop-text .contact {
            font-size: 9pt;
            color: #555;
        }
        
        .kop-spacer {
            width: 150px;
        }
        
        /* Judul Laporan */
        .judul-laporan {
            text-align: center;
            margin: 30px 0 25px 0;
            padding: 15px;
            background: linear-gradient(135deg, #1a5276 0%, #2874a6 100%);
            color: #fff;
            border-radius: 8px;
        }
        
        .judul-laporan h2 {
            font-size: 16pt;
            font-weight: bold;
            margin-bottom: 5px;
            letter-spacing: 2px;
        }
        
        .judul-laporan p {
            font-size: 11pt;
            opacity: 0.9;
        }
        
        /* Info Section */
        .info-section {
            margin-bottom: 25px;
            padding: 15px;
            background: #f8f9fa;
            border-left: 4px solid #1a5276;
            border-radius: 0 5px 5px 0;
        }
        
        .info-section table {
            border: none;
            width: 100%;
        }
        
        .info-section td {
            padding: 5px 10px 5px 0;
            border: none;
            font-size: 11pt;
        }
        
        .info-section td:first-child {
            font-weight: bold;
            width: 150px;
            color: #1a5276;
        }
        
        /* Ringkasan */
        .ringkasan {
            margin-bottom: 30px;
        }
        
        .section-title {
            font-size: 13pt;
            font-weight: bold;
            color: #1a5276;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #1a5276;
            display: flex;
            align-items: center;
        }
        
        .section-title::before {
            content: '';
            display: inline-block;
            width: 8px;
            height: 8px;
            background: #1a5276;
            margin-right: 10px;
            border-radius: 2px;
        }
        
        .ringkasan-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        
        .ringkasan-table th,
        .ringkasan-table td {
            border: 1px solid #1a5276;
            padding: 12px 15px;
            text-align: center;
        }
        
        .ringkasan-table th {
            background: #1a5276;
            color: #fff;
            font-weight: bold;
            font-size: 11pt;
        }
        
        .ringkasan-table td {
            font-size: 11pt;
        }
        
        .ringkasan-table td strong {
            font-size: 14pt;
            color: #1a5276;
        }
        
        .ringkasan-table .total-cell {
            background: #d4e6f1;
        }
        
        .ringkasan-table .sangat-puas {
            background: #d5f5e3;
            color: #196f3d;
        }
        
        .ringkasan-table .puas {
            background: #fcf3cf;
            color: #9a7d0a;
        }
        
        .ringkasan-table .tidak-puas {
            background: #fadbd8;
            color: #922b21;
        }
        
        /* Data Table */
        .data-section {
            margin-bottom: 30px;
        }
        
        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10pt;
        }
        
        .data-table th,
        .data-table td {
            border: 1px solid #bdc3c7;
            padding: 10px 8px;
            text-align: left;
        }
        
        .data-table th {
            background: #1a5276;
            color: #fff;
            font-weight: bold;
            text-align: center;
            font-size: 10pt;
        }
        
        .data-table tbody tr:nth-child(even) {
            background: #f8f9fa;
        }
        
        .data-table tbody tr:hover {
            background: #ebf5fb;
        }
        
        .data-table td.center {
            text-align: center;
        }
        
        .badge {
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 9pt;
            font-weight: bold;
            display: inline-block;
        }
        
        .badge-success {
            background: #27ae60;
            color: #fff;
        }
        
        .badge-warning {
            background: #f39c12;
            color: #fff;
        }
        
        .badge-danger {
            background: #e74c3c;
            color: #fff;
        }
        
        /* Footer / TTD */
        .ttd-section {
            margin-top: 50px;
            page-break-inside: avoid;
        }
        
        .ttd-table {
            width: 100%;
        }
        
        .ttd-table td {
            width: 50%;
            text-align: center;
            vertical-align: top;
            padding: 10px;
        }
        
        .ttd-box {
            text-align: center;
        }
        
        .ttd-box .tempat-tanggal {
            font-size: 11pt;
            margin-bottom: 5px;
        }
        
        .ttd-box .jabatan {
            margin-bottom: 70px;
            font-weight: bold;
        }
        
        .ttd-box .nama {
            font-weight: bold;
            text-decoration: underline;
            font-size: 12pt;
        }
        
        .ttd-box .nip {
            font-size: 10pt;
            color: #555;
        }
        
        /* Footer */
        .footer {
            margin-top: 40px;
            padding-top: 15px;
            border-top: 2px solid #1a5276;
            text-align: center;
            font-size: 9pt;
            color: #666;
        }
        
        .footer img {
            height: 30px;
            margin-bottom: 5px;
        }
        
        /* Print buttons */
        .print-buttons {
            text-align: center;
            margin-bottom: 25px;
            padding: 20px;
            background: linear-gradient(135deg, #1a5276 0%, #2874a6 100%);
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        
        .print-buttons button {
            padding: 12px 30px;
            margin: 0 8px;
            font-size: 14px;
            cursor: pointer;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            transition: all 0.3s;
        }
        
        .btn-print {
            background: #fff;
            color: #1a5276;
        }
        
        .btn-print:hover {
            background: #d4e6f1;
        }
        
        .btn-back {
            background: rgba(255,255,255,0.2);
            color: #fff;
            border: 2px solid #fff !important;
        }
        
        .btn-back:hover {
            background: rgba(255,255,255,0.3);
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
                padding: 10mm 15mm;
            }
            
            .judul-laporan {
                background: #1a5276 !important;
                -webkit-print-color-adjust: exact;
            }
            
            .ringkasan-table th,
            .data-table th {
                background: #1a5276 !important;
                -webkit-print-color-adjust: exact;
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
                ← Kembali ke Laporan
            </button>
        </div>

        <!-- Kop Surat dengan Logo -->
        <div class="kop-surat">
            <div class="kop-logo">
                <img src="{{ asset('images/logoGASNET.png') }}" alt="Logo Gasnet">
            </div>
            <div class="kop-text">
                <h1>GASNET</h1>
                <h2>PT TELEMEDIA DINAMIKA SARANA</h2>
                <p class="alamat">Jl. Raya Industri No. 123, Jakarta Pusat 10110</p>
                <p class="contact">Telp: (021) 1234567 | Fax: (021) 1234568 | Email: info@gasnet.co.id | www.gasnet.co.id</p>
            </div>
            <div class="kop-spacer"></div>
        </div>

        <!-- Judul Laporan -->
        <div class="judul-laporan">
            <h2>LAPORAN ASSESSMENT CUSTOMER</h2>
            <p>Periode: {{ request('start_date') ? date('d/m/Y', strtotime(request('start_date'))) : 'Semua Tanggal' }} s.d. {{ request('end_date') ? date('d/m/Y', strtotime(request('end_date'))) : 'Semua Tanggal' }}</p>
        </div>

        <!-- Info Section -->
        <div class="info-section">
            <table>
                <tr>
                    <td>Tanggal Cetak</td>
                    <td>:</td>
                    <td>{{ now()->format('d F Y, H:i') }} WIB</td>
                </tr>
                <tr>
                    <td>Filter Assessment</td>
                    <td>:</td>
                    <td>
                        @if(request('assessment') && request('assessment') !== 'semua')
                            @if(request('assessment') == 'sangat_puas') Sangat Puas
                            @elseif(request('assessment') == 'puas') Puas
                            @else Tidak Puas
                            @endif
                        @else
                            Semua Assessment
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Dicetak Oleh</td>
                    <td>:</td>
                    <td>{{ auth()->user()->name ?? '-' }}</td>
                </tr>
            </table>
        </div>

        <!-- Ringkasan -->
        <div class="ringkasan">
            <h3 class="section-title">RINGKASAN ASSESSMENT</h3>
            <table class="ringkasan-table">
                <thead>
                    <tr>
                        <th>Total Form</th>
                        <th>Sangat Puas</th>
                        <th>Puas</th>
                        <th>Tidak Puas</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="total-cell">
                            <strong>{{ $stats['total'] }}</strong><br>
                            <small>100%</small>
                        </td>
                        <td class="sangat-puas">
                            <strong>{{ $stats['sangat_puas'] }}</strong><br>
                            <small>{{ $stats['total'] > 0 ? number_format($stats['sangat_puas']/$stats['total']*100, 1) : 0 }}%</small>
                        </td>
                        <td class="puas">
                            <strong>{{ $stats['puas'] }}</strong><br>
                            <small>{{ $stats['total'] > 0 ? number_format($stats['puas']/$stats['total']*100, 1) : 0 }}%</small>
                        </td>
                        <td class="tidak-puas">
                            <strong>{{ $stats['tidak_puas'] }}</strong><br>
                            <small>{{ $stats['total'] > 0 ? number_format($stats['tidak_puas']/$stats['total']*100, 1) : 0 }}%</small>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Data Section -->
        <div class="data-section">
            <h3 class="section-title">DATA DETAIL ASSESSMENT</h3>
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 12%;">Tanggal</th>
                        <th style="width: 22%;">Nama Customer</th>
                        <th style="width: 20%;">Email</th>
                        <th style="width: 15%;">Layanan</th>
                        <th style="width: 13%;">Kapasitas</th>
                        <th style="width: 13%;">Assessment</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($forms as $index => $form)
                        <tr>
                            <td class="center">{{ $index + 1 }}</td>
                            <td class="center">{{ $form->form_date ? $form->form_date->format('d/m/Y') : '-' }}</td>
                            <td>{{ $form->customer->customer_name ?? '-' }}</td>
                            <td>{{ $form->customer->email ?? '-' }}</td>
                            <td>{{ $form->customer->layanan_service ?? '-' }}</td>
                            <td class="center">{{ $form->customer->kapasitas_capacity ?? '-' }}</td>
                            <td class="center">
                                @if($form->assessment == 'sangat_puas')
                                    <span class="badge badge-success">Sangat Puas</span>
                                @elseif($form->assessment == 'puas')
                                    <span class="badge badge-warning">Puas</span>
                                @else
                                    <span class="badge badge-danger">Tidak Puas</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 30px; color: #666;">
                                <em>Tidak ada data yang ditemukan</em>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <p style="font-size: 9pt; color: #666; margin-top: 10px; text-align: right;">
                Total Data: {{ count($forms) }} record
            </p>
        </div>

        <!-- TTD Section -->
        <div class="ttd-section">
            <table class="ttd-table">
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <div class="ttd-box">
                            <p class="tempat-tanggal">Jakarta, {{ now()->format('d F Y') }}</p>
                            <p class="jabatan">Mengetahui,</p>
                            <p class="nama">_________________________</p>
                            <p class="nip">Manager / Supervisor</p>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Footer -->
        <div class="footer">
            <img src="{{ asset('images/logoGASNET.png') }}" alt="Logo Gasnet">
            <p><strong>PT TELEMEDIA DINAMIKA SARANA</strong></p>
            <p>Dokumen ini dicetak secara otomatis oleh Sistem Rating Customer Gasnet</p>
            <p>© {{ date('Y') }} Gasnet - All Rights Reserved</p>
        </div>
    </div>

    <script>
        // Auto print when loaded
        window.onload = function() {
            // Delay sedikit untuk memastikan semua gambar loaded
            setTimeout(function() {
                window.print();
            }, 500);
        }
    </script>
</body>
</html>
