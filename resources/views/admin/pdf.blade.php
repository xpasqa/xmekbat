<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <title>PDF Page</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <img src="images/headerpdf.jpg" alt="" srcset="" />
        </div>
        <br />
        <h5 class="mb-3">Project Information</h5>
        <div class="row">
            <div class="col-lg-4 col">
                <p class="p-0 m-0">Project Name : {{ $project->project_name }}</p>
                <p class="p-0 m-0">Project Location : {{ $project->project_location }}</p>
                <p class="p-0 m-0">Company : {{ $project->company_name }}</p>
                <p class="p-0 m-0">Nama PIC : {{ $project->pic }}</p>
                <p class="p-0 m-0">Email : {{ $project->email }}</p>
                <p class="p-0 m-0">Phone : {{ $project->phone }}</p>
            </div>
        </div>

        <!-- Quotation  -->
        <br />
        <h5 class="mb-3">Quotation</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Test Sample</th>
                    <th scope="col">Rates</th>
                    <th scope="col">Quantity</th>
                    <th scope="col" class="text-center">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($project->orders as $row)
                    <?php $i = 1; ?>
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $row->sample->name }}</td>
                        <td>{{ $row->sample->price_rates }} / {{ $row->sample->sample_rates }} Sample</td>
                        <td class="text-center">{{ $row->quantity }}</td>
                        <td class="text-center">{{ rupiah($row->total) }}</td>
                    </tr>
                    <?php $i++; ?>
                @endforeach
            </tbody>
        </table>

        <!-- Preparation  -->
        <br />
        <h5 class="mb-3">Quotation</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Accepted Date</th>
                    <th scope="col">Process Estimation</th>
                    <th scope="col">Notes</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ indonesianDateFormat($project->accepted_at) }}</td>
                    <td>{{ indonesianDateFormat($project->estimated_opened) }}</td>
                    @if (count($project->notes) > 0)
                        <td>{{ $project->notes[0]['notes'] }}</td>
                    @else
                        <td>-</td>
                    @endif
                </tr>
            </tbody>
        </table>

        <!-- Testing  -->
        <br />
        <h5 class="mb-3">Testing</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Test Categories</th>
                    <th scope="col">Jumlah Sample</th>
                    <th scope="col">Selesai Test</th>
                    <th scope="col">%</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($project->orders as $row)
                    <?php $i = 1; ?>
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $row->sample->name }}</td>
                        <td>{{ $row->sample->sample_rates * $row->quantity }}</td>
                        <td>{{ $row->labtest->selesai_qty }}</td>
                        <td>{{ ($row->labtest->selesai_qty / ($row->sample->sample_rates * $row->quantity)) * 100 }}</td>
                    </tr>
                    <?php $i++; ?>
                @endforeach
            </tbody>
        </table>

        <!-- Invoicing  -->
        <br />
        <h5 class="mb-3">Invoicing</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Status Pembayaran</th>
                    <th scope="col">Process Estimation</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @if (isset($project->bukti_pembayaran))
                        <td>Completed</td>
                    @else
                        <td>-</td>
                    @endif
                    <td>{{ indonesianDateFormat($project->updated_at) }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Survey Kepuasan  -->
        <br />
        <h5 class="mb-3">Survey Kepuasan</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($survey as $row)
                    <tr>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->value }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if (isset($project->saran))
            <div class="row mt-3 m-1">
                <h5>Saran :</h5>
            </div>
            <div class="border border-dark">
                <p class="m-3 text-left">{{ $project->saran }}</p>
            </div>
        @endif
    </div>
    <br /><br />

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
</body>

</html>
