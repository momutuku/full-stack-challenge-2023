@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1>Referrals</h1>
                    </div>
                    <div>@include('partials.filterReferrals') @include('partials.createReferralButton')</div>
                    <div class="panel-body">

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <table class="table" id="referrals">
                            <thead>
                                <tr>
                                    <th>Country</th>
                                    <th>Reference No</th>
                                    <th>Organisation</th>
                                    <th>Province</th>
                                    <th>District</th>
                                    <th>City</th>
                                    <th>Street Address</th>
                                    <th>Gps Location</th>
                                    <th>Facility Name</th>
                                    <th>Facility Type</th>
                                    <th>Provider Name</th>
                                    <th>Position</th>
                                    <th>Phone</th>
                                    <th>eMail</th>
                                    <th>Website</th>
                                    <th>Pills Available</th>
                                    <th>Code To Use</th>
                                    <th>Type of Service</th>
                                    <th>Note</th>
                                    <th>Womens Evaluation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($referrals as $referral)
                                    <tr>
                                        <td>{{ $referral->country }} </td>
                                        <td>{{ $referral->reference_no }} </td>
                                        <td>{{ $referral->organisation }} </td>
                                        <td>{{ $referral->province }} </td>
                                        <td>{{ $referral->district }} </td>
                                        <td>{{ $referral->city }} </td>
                                        <td>{{ $referral->street_address }} </td>
                                        <td>{{ $referral->gps_location }} </td>
                                        <td>{{ $referral->facility_name }} </td>
                                        <td>{{ $referral->facility_type }} </td>
                                        <td>{{ $referral->provider_name }} </td>
                                        <td>{{ $referral->position }} </td>
                                        <td>{{ $referral->phone }} </td>
                                        <td>{{ $referral->email }} </td>
                                        <td>{{ $referral->website }} </td>
                                        <td>{{ $referral->pills_available }} </td>
                                        <td>{{ $referral->code_to_use }} </td>
                                        <td>{{ $referral->type_of_service }} </td>
                                        <td>{{ $referral->note }} </td>
                                        <td>{{ $referral->womens_evaluation }} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="panel-footer">
                        {{ $referrals->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Comment Form Modal -->
    <div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="commentModalLabel">Add Comment for Referral <span
                            id="referralReferenceNo"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/referrals/comment">
                        {{ csrf_field() }}
                        <input type="hidden" id="reference_no" name="reference_no">
                        <div class="form-group">
                            <label for="comment">Comment:</label>
                            <textarea name="comment" id="comment" class="form-control" rows="4" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Save">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <script>
        var $j = jQuery.noConflict();
        $j(document).ready(function() {
            
            $j('#referrals thead tr th').each(function() {
                var column = $j(this).index();
                var select = $j('<select><option value="">All</option></select>')
                    .appendTo($j(this))
                    .on('change', function() {
                        var val = $j(this).val();
                        table.column(column).search(val).draw();

                    });

                // Populate the filter dropdown with unique values
                var uniqueValues = [];

                // Populate the filter dropdown with unique values
                $j('#referrals tbody tr td:nth-child(' + (column + 1) + ')').each(function() {
                    var val = $j(this).text();
                    if (uniqueValues.indexOf(val) === -1) {
                        uniqueValues.push(val);
                        select.append($j('<option></option>').attr('value', val).text(val));
                    }
                });
            });


            var table = $j('#referrals').DataTable();

            table.on('click', 'tbody tr', function() {
                var data = table.row(this).data();
                var reference_no = data[1];

                $('#reference_no').val(reference_no);
                $('#referralReferenceNo').text(reference_no);
                $('#commentModal').modal('show');
            });
        });
    </script>
@endsection
