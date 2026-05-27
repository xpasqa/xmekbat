@extends('templates.header')

<body class="fill-bluewhite order-workflow">
    @extends('templates.navbar')
    @section('content')
        <div class="container p-0 my-5">
            <div class="order-shell">
                @include('templates.sidebar')

                <div class="my-container active-cont order-main">
                    <div class="order-page-header">
                        <h4>Download</h4>
                        <p>Unduh dokumen hasil test dan isi survey kepuasan layanan laboratorium.</p>
                    </div>

                    <div class="order-section">
                        <label class="agreement-card" for="menyetujui">
                            <input class="form-check-input" type="checkbox" value="" id="menyetujui">
                            <span>Dengan ini menyetujui <strong>pembuangan sisa sampel uji</strong> dan menerima laporan data sample.</span>
                        </label>

                        <div class="document-list">
                            @forelse ($project->hasil_image as $row)
                                <div class="document-card">
                                    <span>{{ $row->name }}</span>
                                    <a target="_blank" href="{{ url('storage/order/document/' . $row->image . '') }}" type="submit" class="btn button-primary btn_download">
                                        Download
                                    </a>
                                </div>
                            @empty
                                <div class="empty-state">Dokumen hasil test belum tersedia.</div>
                            @endforelse
                        </div>
                    </div>

                    <div class="order-section">
                        <h5>Survey Kepuasan</h5>
                        <div class="survey-list">
                            <div class="survey-row">
                                <span>1. Ketepatan Waktu</span>
                                <ul class="likert">
                                    <li>
                                        <input type="radio" name="ketepatan_waktu" value="Sangat Baik" {{ optional($survey)->ketepatan_waktu == 'Sangat Baik' ? 'checked ' : '' }}>
                                        <label>Sangat baik</label>
                                    </li>
                                    <li>
                                        <input type="radio" name="ketepatan_waktu" value="Baik" {{ optional($survey)->ketepatan_waktu == 'Baik' ? 'checked ' : '' }}>
                                        <label>Baik</label>
                                    </li>
                                    <li>
                                        <input type="radio" name="ketepatan_waktu" value="Cukup" {{ optional($survey)->ketepatan_waktu == 'Cukup' ? 'checked ' : '' }}>
                                        <label>Cukup</label>
                                    </li>
                                    <li>
                                        <input type="radio" name="ketepatan_waktu" value="Kurang" {{ optional($survey)->ketepatan_waktu == 'Kurang' ? 'checked ' : '' }}>
                                        <label>Kurang</label>
                                    </li>
                                </ul>
                            </div>
                            <div class="survey-row">
                                <span>2. Komunikasi laboratorium dengan pelanggan</span>
                                <ul class="likert">
                                    <li>
                                        <input type="radio" name="komunikasi" value="Sangat Baik" {{ optional($survey)->komunikasi == 'Sangat Baik' ? 'checked ' : '' }}>
                                        <label>Sangat baik</label>
                                    </li>
                                    <li>
                                        <input type="radio" name="komunikasi" value="Baik" {{ optional($survey)->komunikasi == 'Baik' ? 'checked ' : '' }}>
                                        <label>Baik</label>
                                    </li>
                                    <li>
                                        <input type="radio" name="komunikasi" value="Cukup" {{ optional($survey)->komunikasi == 'Cukup' ? 'checked ' : '' }}>
                                        <label>Cukup</label>
                                    </li>
                                    <li>
                                        <input type="radio" name="komunikasi" value="Kurang" {{ optional($survey)->komunikasi == 'Kurang' ? 'checked ' : '' }}>
                                        <label>Kurang</label>
                                    </li>
                                </ul>
                            </div>
                            <div class="survey-row">
                                <span>3. Kejelasan pelaporan</span>
                                <ul class="likert">
                                    <li>
                                        <input type="radio" name="kejelasan" value="Sangat Baik" {{ optional($survey)->kejelasan == 'Sangat Baik' ? 'checked ' : '' }}>
                                        <label>Sangat baik</label>
                                    </li>
                                    <li>
                                        <input type="radio" name="kejelasan" value="Baik" {{ optional($survey)->kejelasan == 'Baik' ? 'checked ' : '' }}>
                                        <label>Baik</label>
                                    </li>
                                    <li>
                                        <input type="radio" name="kejelasan" value="Cukup" {{ optional($survey)->kejelasan == 'Cukup' ? 'checked ' : '' }}>
                                        <label>Cukup</label>
                                    </li>
                                    <li>
                                        <input type="radio" name="kejelasan" value="Kurang" {{ optional($survey)->kejelasan == 'Kurang' ? 'checked ' : '' }}>
                                        <label>Kurang</label>
                                    </li>
                                </ul>
                            </div>
                            <div class="survey-row">
                                <span>4. Kejelasan informasi yang diberikan laboratorium</span>
                                <ul class="likert">
                                    <li>
                                        <input type="radio" name="informasi" value="Sangat Baik" {{ optional($survey)->informasi == 'Sangat Baik' ? 'checked ' : '' }}>
                                        <label>Sangat baik</label>
                                    </li>
                                    <li>
                                        <input type="radio" name="informasi" value="Baik" {{ optional($survey)->informasi == 'Baik' ? 'checked ' : '' }}>
                                        <label>Baik</label>
                                    </li>
                                    <li>
                                        <input type="radio" name="informasi" value="Cukup" {{ optional($survey)->informasi == 'Cukup' ? 'checked ' : '' }}>
                                        <label>Cukup</label>
                                    </li>
                                    <li>
                                        <input type="radio" name="informasi" value="Kurang" {{ optional($survey)->informasi == 'Kurang' ? 'checked ' : '' }}>
                                        <label>Kurang</label>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="survey-suggestion">
                            <label for="saran" class="form-label">Saran</label>
                            <input id="id_survey" type="hidden" class="form-control" value="{{ optional($survey)->id_survey }}">
                            <textarea id="saran" class="form-control" rows="4" placeholder="Masukan saran">{{ $project->saran }}</textarea>
                        </div>
                    </div>

                    <div class="order-actions">
                        <a href="{{ route('user.invoice') }}" class="btn button-primary-outline">Back</a>
                        <button id="submit" type="submit" class="btn button-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
@endsection
@extends('order.js.download-js')
@extends('order.user.globaluserscript')
