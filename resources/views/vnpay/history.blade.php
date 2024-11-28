@extends('layout.layout')
@section('content')
<section class="section-hero overlay inner-page bg-image" style="background-image: url('/temp/images/vnpay.jpg');" id="home-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="custom-breadcrumbs mb-0 text-white font-weight-bold">
            <span class="slash text-white font-weight-bold">Lịch sử nạp tiền
          </div>
          <h1 class="text-white">Danh sách nạp tiền</h1>
          
        </div>
      </div>
    </div>

</section>
<section class="site-section">
    <div class="container">
        <h2 class="mb-4">Lịch sử nạp tiền</h2>
        
        <table class="table text-dark table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã đơn hàng</th>
                    <th>Số tiền</th>
                    <th>Ngân hàng</th>
                    <th>Trạng thái giao dịch</th>
                    <th>Mã giao dịch</th>
                    <th>Thời gian</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($payments as $payment)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $payment->order_code }}</td>
                        <td>{{ number_format($payment->amount_money, 0, ',', '.') }} VND</td>
                        <td>{{ $payment->BankCode ?? 'Không xác định' }}</td>
                        <td>
                            @if($payment->TransactionStatus == 1)
                                <span class="badge bg-success p-2">Thành công</span>
                            @else
                                <span class="badge bg-danger p-2">Thất bại</span>
                            @endif
                        </td>
                        <td>{{ $payment->TransactionNo ?? 'Không có' }}</td>
                        <td>{{ $payment->created_at->format('H:i:s d/m/Y') }}</td>
                        {{-- <td>
                            <a href="{{ route('payment.details', ['id' => $payment->id]) }}" class="btn btn-info btn-sm">
                                Xem chi tiết
                            </a>
                        </td> --}}
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Không có lịch sử thanh toán.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="pagination mt-4">
            {{ $payments->links() }}
        </div>
    </div>
</section>
@endsection