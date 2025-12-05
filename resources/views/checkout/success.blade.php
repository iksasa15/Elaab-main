@extends('layouts.app')

@section('title', 'Order Completed - El3bha')

@section('content')
    <div style="background-color: #1E1D2F; min-height: 100vh; padding: 40px 0;">
        <div class="container" style="max-width: 800px; margin: 0 auto;">
            <!-- بطاقة رئيسية تحتوي على جميع المحتويات -->
            <div
                style="background-color: #242338; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.2); overflow: hidden; margin-bottom: 30px;">

                <!-- قسم الشعار والتأكيد -->
                <div style="text-align: center; padding: 40px 20px 30px;">
                    <!-- أيقونة النجاح -->
                    <div style="margin-bottom: 25px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="110" height="110" fill="#5BD968" viewBox="0 0 16 16"
                            style="filter: drop-shadow(0 4px 6px rgba(91, 217, 104, 0.3));">
                            <path
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                        </svg>
                    </div>

                    <!-- عنوان التأكيد -->
                    <h1 style="font-size: 2.8rem; font-weight: 700; color: #8C7DFF; margin: 0 0 15px; line-height: 1.2;">
                        Thank You for Your Order!</h1>

                    <!-- رسالة تأكيد -->
                    <p
                        style="font-size: 1.15rem; color: #B2B2CC; margin-bottom: 25px; max-width: 600px; margin-left: auto; margin-right: auto;">
                        Your order has been successfully completed and is being processed
                    </p>

                    <!-- رقم الطلب -->
                    <div
                        style="background-color: #2C2A3E; padding: 15px; border-radius: 12px; max-width: 300px; margin: 0 auto; border: 1px solid #3A384E;">
                        <div style="display: flex; justify-content: center; align-items: center;">
                            <span style="color: #E5E5E5; font-size: 1.1rem;">Order Number:</span>
                            <span
                                style="color: #8C7DFF; font-size: 1.2rem; margin-left: 10px; font-weight: 600;">#{{ $order->id }}</span>
                        </div>
                    </div>
                </div>

                <!-- قسم تفاصيل الطلب -->
                <div style="padding: 0 30px 30px;">
                    <!-- عنوان القسم مع الخط الفاصل -->
                    <div style="margin-bottom: 20px; position: relative;">
                        <div
                            style="position: absolute; top: 50%; left: 0; right: 0; height: 1px; background-color: #3A384E;">
                        </div>
                        <h2
                            style="position: relative; background-color: #242338; display: inline-block; padding-right: 20px; margin: 0; color: #E5E5E5; font-size: 1.6rem; font-weight: 600;">
                            Order Details
                        </h2>
                    </div>

                    <!-- جدول تفاصيل الطلب -->
                    <div
                        style="background-color: #27263B; border-radius: 12px; overflow: hidden; margin-bottom: 40px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="background-color: #2C2A3E;">
                                    <th
                                        style="padding: 16px 20px; color: #E5E5E5; text-align: left; font-weight: 600; font-size: 1.05rem;">
                                        Game</th>
                                    <th
                                        style="padding: 16px 20px; color: #E5E5E5; text-align: center; font-weight: 600; font-size: 1.05rem;">
                                        Duration</th>
                                    <th
                                        style="padding: 16px 20px; color: #E5E5E5; text-align: right; font-weight: 600; font-size: 1.05rem;">
                                        Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                    <tr>
                                        <td style="padding: 16px 20px; border-top: 1px solid #3A384E;">
                                            <div style="display: flex; align-items: center;">
                                                @if($item->game->image)
                                                    <div
                                                        style="width: 65px; height: 65px; overflow: hidden; border-radius: 10px; margin-right: 15px; flex-shrink: 0;">
                                                        <img src="{{ $item->game->image }}" alt="{{ $item->game->name }}"
                                                            style="width: 100%; height: 100%; object-fit: cover; border: 2px solid #3A384E;">
                                                    </div>
                                                @endif
                                                <span
                                                    style="color: #E5E5E5; font-weight: 500; font-size: 1.05rem;">{{ $item->game->name }}</span>
                                            </div>
                                        </td>
                                        <td
                                            style="padding: 16px 20px; border-top: 1px solid #3A384E; text-align: center; vertical-align: middle;">
                                            <span
                                                style="background-color: #37365A; color: #8C7DFF; padding: 6px 14px; border-radius: 20px; font-size: 0.9rem; display: inline-block;">
                                                {{ $item->duration }} days
                                            </span>
                                        </td>
                                        <td
                                            style="padding: 16px 20px; border-top: 1px solid #3A384E; text-align: right; vertical-align: middle; color: #8C7DFF; font-weight: 600; font-size: 1.2rem;">
                                            {{ number_format($item->price, 2) }} SAR
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr style="background-color: #2C2A3E;">
                                    <td colspan="2"
                                        style="padding: 16px 20px; text-align: right; color: #E5E5E5; font-weight: 600; font-size: 1.05rem;">
                                        Total:</td>
                                    <td
                                        style="padding: 16px 20px; text-align: right; color: #8C7DFF; font-weight: 700; font-size: 1.3rem;">
                                        {{ number_format($order->total_price, 2) }} SAR
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- قسم معلومات الطلب -->
                    <div>
                        <!-- عنوان القسم مع الخط الفاصل -->
                        <div style="margin-bottom: 20px; position: relative;">
                            <div
                                style="position: absolute; top: 50%; left: 0; right: 0; height: 1px; background-color: #3A384E;">
                            </div>
                            <h2
                                style="position: relative; background-color: #242338; display: inline-block; padding-right: 20px; margin: 0; color: #E5E5E5; font-size: 1.6rem; font-weight: 600;">
                                Order Information
                            </h2>
                        </div>

                        <!-- بطاقات المعلومات -->
                        <div style="display: flex; flex-wrap: wrap; margin: 0 -10px 30px;">
                            <div style="width: 50%; padding: 0 10px; box-sizing: border-box; margin-bottom: 20px;">
                                <div
                                    style="background-color: #27263B; border-radius: 12px; padding: 20px; height: 100%; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                                    <h5 style="color: #B2B2CC; font-size: 1rem; margin-top: 0; margin-bottom: 15px;">Order
                                        Status</h5>
                                    <div>
                                        <span
                                            style="background-color: #37365A; color: #8C7DFF; padding: 8px 16px; border-radius: 20px; font-size: 1rem; display: inline-block;">
                                            {{ $order->state }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div style="width: 50%; padding: 0 10px; box-sizing: border-box; margin-bottom: 20px;">
                                <div
                                    style="background-color: #27263B; border-radius: 12px; padding: 20px; height: 100%; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                                    <h5 style="color: #B2B2CC; font-size: 1rem; margin-top: 0; margin-bottom: 15px;">Order
                                        Date</h5>
                                    <p style="color: #E5E5E5; font-size: 1rem; margin: 0;">
                                        {{ $order->created_at->format('d/m/Y - h:i A') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- الرسالة الختامية والأزرار -->
                        <div style="border-top: 1px solid #3A384E; padding-top: 30px; text-align: center;">
                            <p style="color: #B2B2CC; font-size: 1.1rem; margin-bottom: 25px;">
                                We will contact you soon to complete the rental process
                            </p>
                            <div style="display: flex; justify-content: center; gap: 15px; flex-wrap: wrap;">
                                <a href="{{ route('home') }}"
                                    style="background-color: #8C7DFF; color: #fff; padding: 12px 24px; border-radius: 10px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; transition: all 0.2s; box-shadow: 0 4px 15px rgba(140, 125, 255, 0.3);">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        style="margin-right: 8px;" viewBox="0 0 16 16">
                                        <path
                                            d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z" />
                                    </svg>
                                    Return to Home
                                </a>
                                <a href="{{ route('games.index') }}"
                                    style="background-color: transparent; border: 1px solid #8C7DFF; color: #E5E5E5; padding: 12px 24px; border-radius: 10px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; transition: all 0.2s;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        style="margin-right: 8px;" viewBox="0 0 16 16">
                                        <path
                                            d="M11.5 6.027a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m-1.5 1.5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1m2.5-.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m-1.5 1.5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1m-6.5-3h1v1h1v1h-1v1h-1v-1h-1v-1h1z" />
                                        <path
                                            d="M3.051 3.26a.5.5 0 0 1 .354-.613l1.932-.518a.5.5 0 0 1 .62.39c.655-.079 1.35-.117 2.043-.117.72 0 1.443.041 2.12.126a.5.5 0 0 1 .622-.399l1.932.518a.5.5 0 0 1 .306.729c.14.09.266.19.373.297.408.408.78 1.05 1.095 1.772.32.733.599 1.591.805 2.466.206.875.34 1.78.364 2.606.024.816-.059 1.602-.328 2.21a1.42 1.42 0 0 1-1.445.83c-.636-.067-1.115-.394-1.513-.773-.245-.232-.496-.526-.739-.808-.126-.148-.25-.292-.368-.423-.728-.804-1.597-1.527-3.224-1.527-1.627 0-2.496.723-3.224 1.527-.119.131-.242.275-.368.423-.243.282-.494.575-.739.808-.398.38-.877.706-1.513.773a1.42 1.42 0 0 1-1.445-.83c-.27-.608-.352-1.395-.329-2.21.024-.826.16-1.73.365-2.606.206-.875.486-1.733.805-2.466.315-.722.687-1.364 1.094-1.772a2.34 2.34 0 0 1 .382-.297.5.5 0 0 1 .306-.729l1.932-.518a.5.5 0 0 1 .61.39c.16-.018.33-.039.51-.039.184 0 .364.021.534.04.01-.103.022-.205.034-.308z" />
                                    </svg>
                                    Browse Games
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection