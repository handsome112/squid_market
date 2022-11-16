@extends('staff.admin.adminmain')
@section('content')
<title>Admin Withdrawals - Squid Market</title>
<!-- Withdrawals Start -->
<div class="bg-primary text-center rounded p-2 mx-4 mt-4">
    <h4 class="mb-0" style="color:white">Withdrawals</h4>
</div>
<div class="container-fluid pt-4 px-4">
    <form class="d-none d-md-flex">
        <input class="form-control bg-secondary border-0 mb-3" style="width:300px;margin-left:auto" type="search"
            placeholder="Search">
    </form>
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">Created On</th>
                        <th scope="col">Username</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Transaction ID</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>01/01/22</td>
                        <td>Rockleo</td>
                        <td>$875</td>
                        <td>75958fb67ac26c9307cbc1df32ece8a116d2720a7a8db5d8ef5b1ef2abf29641</td>
                        <td>Confirming 0/10...</td>

                    </tr>
                    <tr>
                        <td>01/01/22</td>
                        <td>Rockleo</td>
                        <td>$875</td>
                        <td>75958fb67ac26c9307cbc1df32ece8a116d2720a7a8db5d8ef5b1ef2abf29641</td>
                        <td>Confirming 5/10...</td>
                    </tr>
                    <tr>
                        <td>01/01/22</td>
                        <td>Rockleo</td>
                        <td>$875</td>
                        <td>75958fb67ac26c9307cbc1df32ece8a116d2720a7a8db5d8ef5b1ef2abf29641</td>
                        <td>Confirmed</td>
                    </tr>
                    <tr>
                        <td>01/01/22</td>
                        <td>Rockleo</td>
                        <td>$875</td>
                        <td>75958fb67ac26c9307cbc1df32ece8a116d2720a7a8db5d8ef5b1ef2abf29641</td>
                        <td>Confirming 2/10...</td>
                    </tr>
                    <tr>
                        <td>01/01/22</td>
                        <td>Rockleo</td>
                        <td>$875</td>
                        <td>75958fb67ac26c9307cbc1df32ece8a116d2720a7a8db5d8ef5b1ef2abf29641</td>
                        <td>Confirming 0/10...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Withdrawals End -->
@stop