<style>
    td{
        min-width: 200px;
    }
</style>
<table>
    <thead>
        <tr>
            <td colspan="11" style="text-align: center"><h1>Danh sách chi</h1></td>
        </tr>
        <tr>
            <td width="150px">Ngày bắt đầu</td>
            <td width="150px">Ngày kết thúc</td>
            <td width="150px">Tình trạng</td>
            <td width="150px">Nhân viên</td>
            <td width="150px">Giá trị tìm kiếm</td>
        </tr>
        <tr>
            <td>{{$search['fromDate']}}</td>
            <td>{{$search['toDate']}}</td>
            <td>{{$search['status']}}</td>
            <td>{{$search['staff']}}</td>
            <td>{{$search['value']}}</td>
        </tr>
        <tr></tr>
        <tr>                                
            <th>NGÀY</th>
            <th>TÊN KHÁCH HÀNG</th>
            <th>SỐ ĐIỆN THOẠI</th>
            <th>TỒNG TIỀN</th>
            <th>CHI TRẢ</th>
            <th width="150px">NỢ</th>
            <th width="150px">TÌNH TRẠNG</th>
    </thead>
    <tbody>
        @php
        $tempId = null;
        @endphp
        @foreach ($items['data'] as $item)

        <tr>
            <th>{{$item->create_date}}</th>
            <th>{{$item->name}}</th>
            <th>{{$item->phone}}</th>
            <th>{{$item->amount}}</th>
            <th>{{$item->payment}}</th>
            <th>{{$item->debt}}</th>
            <th>
                @if ($item->status == 1)
                Hoàn thành
                @else
                    @if ($item->debt_date <=15)
                    <p class="text-danger">Dưới 15 ngày.</p>
                    @elseif($item->debt_date > 30)
                    <p class="text-danger">Trên 30 ngày.</p>
                    @else
                    <p class="text-danger">Trên 15 ngày.</p>
                    @endif
                @endif
            </th>
        </tr>
        @endforeach
    </tbody>
</table>