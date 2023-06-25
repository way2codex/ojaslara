@extends('layouts.app')

@section('content')
<style>
    td {
        padding: 0px !important;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Fetch Data From - {{ $store_data['name'] }}</div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.store_update_notes') }}" id="add_form" name="add_form">
                        @csrf
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Notes</label>
                            <input type="hidden" value="{{ $store_data['id'] }}" class="form-control" id="store_id" name="store_id" placeholder="Name">
                            <textarea class="form-control" id="notes" name="notes">{{ $store_data['notes'] }}</textarea>
                            <button type="submit" class="btn btn-primary form-control ">Submit</button>
                        </div>
                    </form>
                    <table class="table table-bordered">
                        <tr>
                            <td>Url</td>
                            <td>{{ $store_data['website_url'] }}</td>
                        </tr>
                        <tr>
                            <td>Total Data Count(Last Count)</td>
                            <td><span class="total_data_count">{{ $store_data['total_data_count'] }}</span>
                                (<span class="last_freq_data_count">{{ $store_data['last_freq_data_count'] }}</span>)
                            </td>
                        </tr>
                        <tr>
                            <td>Last Freq Completed</td>
                            <td><span class="last_freq_completed">{{ $store_data['last_freq_completed'] }}</span>
                            </td>
                        </tr>
                    </table>
                    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.fetch_manual_data') }}" id="add_form" name="add_form">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="hidden" value="{{ $store_data['id'] }}" class="form-control" id="store_id" name="store_id" placeholder="Name">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputEmail4">Page</label>
                                <input value="1" type="number" class="form-control" id="page" name="page" placeholder="Page no">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputEmail4">Per Page</label>
                                <input value="10" type="number" max="100" min="1" class="form-control" id="per_page" name="per_page" placeholder="Per Page Data">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputEmail4">-</label>
                                <button type="button" class="btn btn-primary form-control fetch_btn">Fetch</button>
                            </div>
                        </div>
                    </form>
                    <div class="card-header form_response">
                        Count : <p class="data_count"></p>
                        Header : <p class="header"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(document).on('click', '.fetch_btn', function(e) {
            $('.fetch_btn').prop('disabled', true);
            e.preventDefault();

            var page = $("#page").val();
            var per_page = $("#per_page").val();
            var store_id = $("#store_id").val();
            $('.data_count').html("<b style='color:green;'>Fetching...</b>");
            $('.header').html("<b style='color:green;'>Fetching...</b>");
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.fetch_manual_data') }}",
                data: {
                    page: page,
                    per_page: per_page,
                    store_id: store_id
                },
                success: function(data) {
                    var header_text = data.header;
                    $('.data_count').html(data.data_count);
                    $('.total_data_count').html(data.store_data.total_data_count);
                    $('.last_freq_data_count').html(data.store_data.last_freq_data_count);
                    $('.last_freq_completed').html(data.store_data.last_freq_completed);
                    $('.header').html(header_text.replaceAll('\r\n', "<br />"));
                    $('.fetch_btn').prop('disabled', false);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('.header').html("Error : " + jqXHR.responseText);
                    $('.fetch_btn').prop('disabled', false);
                }
            });
        });
    });
</script>
@endsection