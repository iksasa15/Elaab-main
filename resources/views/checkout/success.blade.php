@extends('layouts.app')

@section('title', 'Order Completed - El3bha')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <!-- تغيير عرض العمود لجعل المحتوى متمركز بشكل أفضل -->
            <div class="col-md-10 mx-auto">
                <div class="card text-center"
                    style="background-color: var(--card-background); border: none; box-shadow: var(--card-shadow); max-width: 900px; margin: 0 auto;">
                    <div class="card-body p-md-5">
                        <div class="text-center mb-4">
                            <div class="mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="var(--success-color)"
                                    class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                </svg>
                            </div>
                            <h1 class="card-title mb-3"
                                style="font-size: 2.5rem; font-weight: 700; color: var(--primary-color);">Thank You for Your
                                Order!</h1>
                            <p class="text-muted" style="font-size: 1.1rem; color: var(--secondary-text) !important;">Your
                                order has been successfully completed and is being processed</p>
                            <div class="alert mx-auto"
                                style="background-color: rgba(9, 132, 227, 0.1); border: none; border-radius: var(--border-radius); padding: 15px; max-width: 300px; margin: 0 auto;">
                                <strong style="color: var(--primary-text);">Order Number: </strong>
                                <span style="color: var(--primary-color); font-weight: 600;">#{{ $order->id }}</span>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5 class="mb-3 fw-bold position-relative text-center"
                                style="font-size: 1.5rem; color: var(--primary-text);">
                                <span
                                    style="display: inline-block; width: 50px; height: 3px; background-color: var(--primary-color); border-radius: 3px; margin-bottom: 10px;"></span>
                                <br>Order Details
                            </h5>
                            <div class="table-responsive mx-auto"
                                style="border-radius: var(--border-radius); overflow: hidden; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1); max-width: 800px;">
                                <table class="table text-center">
                                    <thead style="background-color: var(--card-background);">
                                        <tr>
                                            <th
                                                style="color: var(--primary-text); border-bottom: 1px solid rgba(255, 255, 255, 0.1); padding: 15px;">
                                                Game</th>
                                            <th
                                                style="color: var(--primary-text); border-bottom: 1px solid rgba(255, 255, 255, 0.1); padding: 15px;">
                                                Duration</th>
                                            <th
                                                style="color: var(--primary-text); border-bottom: 1px solid rgba(255, 255, 255, 0.1); padding: 15px;">
                                                Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->items as $item)
                                            <tr style="background-color: rgba(45, 45, 68, 0.5);">
                                                <td
                                                    style="color: var(--primary-text); border-bottom: 1px solid rgba(255, 255, 255, 0.05); padding: 15px;">
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        @if($item->game->image)
                                                            <img src="{{ $item->game->image }}" alt="{{ $item->game->name }}"
                                                                style="width: 60px; height: 60px; object-fit: cover; border-radius: var(--border-radius); border: 2px solid var(--primary-color); margin-right: 15px;">
                                                        @endif
                                                        <span style="font-weight: 600;">{{ $item->game->name }}</span>
                                                    </div>
                                                </td>
                                                <td
                                                    style="color: var(--primary-text); border-bottom: 1px solid rgba(255, 255, 255, 0.05); padding: 15px; vertical-align: middle;">
                                                    <span class="badge"
                                                        style="background-color: rgba(9, 132, 227, 0.2); color: var(--secondary-color); font-size: 0.9rem; padding: 8px 15px; border-radius: 20px;">
                                                        {{ $item->duration }} days
                                                    </span>
                                                </td>
                                                <td
                                                    style="color: var(--primary-color); border-bottom: 1px solid rgba(255, 255, 255, 0.05); padding: 15px; vertical-align: middle; font-weight: 700; font-size: 1.2rem;">
                                                    {{ number_format($item->price, 2) }} SAR
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr style="background-color: var(--card-background);">
                                            <th colspan="2" class="text-end"
                                                style="color: var(--primary-text); padding: 15px;">Total:</th>
                                            <th style="color: var(--primary-color); padding: 15px; font-size: 1.3rem;">
                                                {{ number_format($order->total_price, 2) }} SAR
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <div class="mb-5">
                            <h5 class="mb-3 fw-bold position-relative text-center"
                                style="font-size: 1.5rem; color: var(--primary-text);">
                                <span
                                    style="display: inline-block; width: 50px; height: 3px; background-color: var(--primary-color); border-radius: 3px; margin-bottom: 10px;"></span>
                                <br>Order Information
                            </h5>
                            <div class="row justify-content-center" style="max-width: 600px; margin: 0 auto;">
                                <div class="col-md-5 mb-3">
                                    <div class="card h-100"
                                        style="background-color: rgba(45, 45, 68, 0.5); border: none; border-radius: var(--border-radius); box-shadow: var(--card-shadow); transition: transform 0.3s;">
                                        <div class="card-body p-4 text-center">
                                            <h6 class="card-title mb-3"
                                                style="color: var(--secondary-text); font-size: 1rem;">Order Status</h6>
                                            <p class="card-text">
                                                <span class="badge"
                                                    style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); font-size: 0.9rem; padding: 8px 15px; border-radius: 20px;">
                                                    {{ $order->state }}
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 mb-3">
                                    <div class="card h-100"
                                        style="background-color: rgba(45, 45, 68, 0.5); border: none; border-radius: var(--border-radius); box-shadow: var(--card-shadow); transition: transform 0.3s;">
                                        <div class="card-body p-4 text-center">
                                            <h6 class="card-title mb-3"
                                                style="color: var(--secondary-text); font-size: 1rem;">Order Date</h6>
                                            <p class="card-text" style="color: var(--primary-text); font-size: 1.1rem;">
                                                {{ $order->created_at->format('d/m/Y - h:i A') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-5"
                            style="border-top: 1px solid rgba(255, 255, 255, 0.08); padding-top: 30px; max-width: 600px; margin: 0 auto;">
                            <p class="text-muted mb-4" style="color: var(--secondary-text) !important; font-size: 1.1rem;">
                                We will contact you soon to complete the rental process</p>
                            <div class="d-flex justify-content-center gap-3">
                                <a href="{{ route('home') }}" class="btn btn-primary"
                                    style="background-color: var(--primary-color); border: none; padding: 12px 25px; border-radius: var(--border-radius); font-weight: 600; box-shadow: 0 6px 15px rgba(108, 92, 231, 0.3); transition: all var(--transition-speed);">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-house me-2" viewBox="0 0 16 16">
                                        <path
                                            d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z" />
                                    </svg>
                                    Return to Home
                                </a>
                                <a href="{{ route('games.index') }}" class="btn btn-outline"
                                    style="background-color: transparent; border: 1px solid var(--primary-color); color: var(--primary-text); padding: 12px 25px; border-radius: var(--border-radius); font-weight: 600; transition: all var(--transition-speed);">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-controller me-2" viewBox="0 0 16 16">
                                        <path
                                            d="M11.5 6.027a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m-1.5 1.5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1m2.5-.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m-1.5 1.5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1m-6.5-3h1v1h1v1h-1v1h-1v-1h-1v-1h1z" />
                                        <path
                                            d="M3.051 3.26a.5.5 0 0 1 .354-.613l1.932-.518a.5.5 0 0 1 .62.39c.655-.079 1.35-.117 2.043-.117.72 0 1.443.041 2.12.126a.5.5 0 0 1 .622-.399l1.932.518a.5.5 0 0 1 .306.729c.14.09.266.19.373.297.408.408.78 1.05 1.095 1.772.32.733.599 1.591.805 2.466.206.875.34 1.78.364 2.606.024.816-.059 1.602-.328 2.21a1.42 1.42 0 0 1-1.445.83c-.636-.067-1.115-.394-1.513-.773-.245-.232-.496-.526-.739-.808-.126-.148-.25-.292-.368-.423-.728-.804-1.597-1.527-3.224-1.527-1.627 0-2.496.723-3.224 1.527-.119.131-.242.275-.368.423-.243.282-.494.575-.739.808-.398.38-.877.706-1.513.773a1.42 1.42 0 0 1-1.445-.83c-.27-.608-.352-1.395-.329-2.21.024-.826.16-1.73.365-2.606.206-.875.486-1.733.805-2.466.315-.722.687-1.364 1.094-1.772a2.34 2.34 0 0 1 .382-.297.5.5 0 0 1 .306-.729l1.932-.518a.5.5 0 0 1 .61.39c.16-.018.33-.039.51-.039.184 0 .364.021.534.04.01-.103.022-.205.034-.308zm5.858 8.337c-.287.3-.567.582-.957.956-.41.373-.978.694-1.735.694-.781 0-1.348-.331-1.742-.71a9 9 0 0 1-.925-.912c-.09-.104-.184-.212-.278-.319-.537-.62-1.155-1.057-2.242-1.057-1.105 0-1.722.444-2.252 1.068a8 8 0 0 1-1.202 1.23c-.395.378-.962.71-1.743.71-.757 0-1.325-.321-1.736-.694-.39-.373-.67-.656-.957-.956C.13 10.515 0 9.408 0 8.172c0-1.25.13-2.371.299-3.373.096-.566.305-1.136.54-1.66.349-.77.793-1.452 1.208-1.866C2.178 1.14 2.322 1 2.5 1c.203 0 .406.07.61.164.296.137.635.329.962.51.34.186.668.359.986.514a.2.2 0 0 0 .152.02 24 24 0 0 1 5.58 0 .2.2 0 0 0 .152-.02c.318-.155.646-.328.985-.514.327-.181.666-.373.962-.51A1.5 1.5 0 0 1 13.5 1c.178 0 .322.14.453.273.415.414.86 1.096 1.208 1.866.235.524.444 1.094.54 1.66.17 1.002.299 2.123.299 3.373 0 1.236-.13 2.344-.299 3.426zm-.664-4.449c0-1.765-.792-3.3-2.331-4.128C10.558 4.422 10.092 4.5 9.5 4.5c-.773 0-1.312-.202-1.903-.429C7.01 3.84 6.42 3.5 5.5 3.5c-.92 0-1.51.34-2.097.571C2.812 4.298 2.273 4.5 1.5 4.5c-.592 0-1.058-.078-1.414-.355C-.671 5.064-1 6.796-1 8.044c0 1.253.333 3 1 4a4.4 4.4 0 0 0 1.5 1.5c.75.357 1.52.5 2 .5.75 0 1.245-.244 1.664-.56.41-.313.834-.765 1.146-1.093.364-.38.761-.7 1.19-.937.19-.106.452-.215.745-.215s.555.11.745.216c.428.236.825.558 1.19.937.312.328.735.78 1.146 1.093.42.316.914.56 1.664.56.48 0 1.25-.143 2-.5a4.4 4.4 0 0 0 1.5-1.5c.667-1 1-2.747 1-4 0-1.248-.329-2.98-2.086-4.399z" />
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