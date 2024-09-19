<style> 
.nav-link.active{
    background-color: #6a73fa!important;
    color: #fff!important;
}
.nav-link{
border: 1px solid!important;
}
</style>
@php($studentId=request('student_id'))
<div class="home-tab" style="margin-top:10px;margin-bottom:5px;">
    <div class="d-sm-flex align-items-center justify-content-between border-bottom">
        <ul class="nav nav-tabs" role="tablist">
            
            <li class="nav-item">
            <a class="nav-link {{ ( request()->is('orders/new') || request()->is('orders/new/'.$studentId)) ? 'active' : '' }}" href="{{route('orders.new',$studentId)}}">New orders</a>
            </li>
            <li class="nav-item">
            <a class="nav-link {{ ( request()->is('orders/ongoing') || request()->is('orders/ongoing/'.$studentId)) ? 'active' : '' }}" href="{{route('orders.ongoing',$studentId)}}">On going order</a>
            </li>
            <li class="nav-item">
            <a class="nav-link {{ ( request()->is('orders/completed') || request()->is('orders/completed/'.$studentId)) ? 'active' : '' }}" href="{{route('orders.completed',$studentId)}}">Completed orders</a>
            </li>

            <?php /*<li class="nav-item">
            <a class="nav-link {{ ( request()->is('orders/payment') || request()->is('orders/payment/'.$studentId)) ? 'active' : '' }}" href="{{route('orders.payment_done',$studentId)}}">Payment Done</a>
            </li>*/ ?>

            <li class="nav-item">
            <a class="nav-link {{ ( request()->is('orders/payment-failed') || request()->is('orders/payment-failed/'.$studentId)) ? 'active' : '' }}" href="{{route('orders.enquery',$studentId)}}">Payment Failed</a>
            </li>
        </ul>
    </div>
</div>