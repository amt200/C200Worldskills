@extends('layouts.master')
@section('content')
    <div class="panel-heading">

        <h2 class="mt-3 mb-3">WorldSkills Conference 2019</h2>
        <hr/>
        <form method = "post" action="#">
            <div class="form-group">

                <div class="form-check-inline">
                    <div class="card">
                        <div class="card-body">
                            <input type="checkbox" id="check1" name="ticket[]" value="normal" class="ticket form-check-input">Normal Ticket
                        </div>
                    </div>
                </div>
                <div class="form-check-inline">
                    <div class="card">
                        <div class="card-body">
                            <input type="checkbox" id="check2" name="ticket[]" value="earlyBird" class="ticket form-check-input">Early Bird
                        </div>
                    </div>
                </div>
                <div class="form-check-inline">
                    <div class="card">
                        <div class="card-body">
                            <input type="checkbox" id="check3" name="ticket[]" value="hotelPack" class="ticket form-check-input">Hotel Package
                        </div>
                    </div>


                </div>
            </div>
            <div class="form-group">
                <label>Select Additional Workshops you want to book:</label>
                <div class="form-check">
                    <label class="form-check-label" for="check1">
                        <input type="checkbox" id="check1" name="additional[]" value="y" class="workshop form-check-input">Designing Skills path
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label" for="check2">
                        <input type="checkbox" id="check2" name="additional[]" value="g" class="workshop form-check-input">Education ecosystem
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label" for="check3">
                        <input type="checkbox" id="check3" name="additional[]" value="g" class="workshop form-check-input">Training and innovate
                    </label>
                </div>
                <div class="form-group">
                    <div class="float-right">
                        Event Ticket: <br>
                        Additional Workshops: <br>
                        <hr style="color: black "></hr>
                        Total:
                        <input class=" float-right btn btn-block btn-primary" type="submit" value="Purchase"/>
                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection
