@extends('crm.layout')
@section('content')
    @include('crm.customers')
    @include('crm.deals')
    @include('crm.instruments')
    @include('crm.finance')
    <div class="item task notenabled">
        <strong class="active">Tasks<span>22</span></strong>
        <ul>
            <li>
                <p><a href="#">Contact customer</a></p>
                <p class="inform"></p>
            </li>
            <li>
                <p><a href="#">Find information about deposite</a></p>
                <p class="inform"></p>
            </li>
            <li>
                <p><a href="#">Check deposite of customer</a></p>
                <p class="inform"></p>
            </li>
            <li>
                <p><a href="#">Make a call to the manager</a></p>
                <p class="inform"></p>
            </li>
        </ul>
        <a href="#" class="more">See more tasks ></a>
    </div>


    <div class="item notenabled">
        <strong>Marketing<span>22</span></strong>
        <ul>
            <li>
                <p><a href="#" id="affiliate">Affiliate users</a></p>
                <p class="num">120</p>
                <p class="last_num">16</p>
            </li>
            <li>
                <p><a href="#" id="cust_inver">Import leads</a></p>
                <p class="num">117</p>
                <p class="last_num">5</p>
            </li>
        </ul>
    </div>
@endsection

@section('popup')
    
@endsection
