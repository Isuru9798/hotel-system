<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .card {
            --background: #fff;
            --background-checkbox: #0082ff;
            --background-image: #fff, rgba(0, 107, 175, 0.2);
            --text-color: #666;
            --text-headline: #000;
            --card-shadow: #0082ff;
            /* --card-height: 190px;
            --card-width: 190px; */
            --card-width: 100%;
            --card-radius: 12px;
            --header-height: 47px;
            --blend-mode: overlay;
            --transition: 0.15s;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .card:nth-child(odd) .card__body-cover-image {
            --x-y1: 100% 90%;
            --x-y2: 67% 83%;
            --x-y3: 33% 90%;
            --x-y4: 0% 85%;
        }

        .card:nth-child(even) .card__body-cover-image {
            --x-y1: 100% 85%;
            --x-y2: 73% 93%;
            --x-y3: 25% 85%;
            --x-y4: 0% 90%;
        }

        .card__input {
            position: absolute;
            display: block;
            outline: none;
            border: none;
            background: none;
            padding: 0;
            margin: 0;
            -webkit-appearance: none;
        }

        .card__input:checked~.card__body {
            --shadow: 0 0 0 3px var(--card-shadow);
        }

        .card__input:checked~.card__body .card__body-cover-checkbox {
            --check-bg: var(--background-checkbox);
            --check-border: #fff;
            --check-scale: 1;
            --check-opacity: 1;
        }

        .card__input:checked~.card__body .card__body-cover-checkbox--svg {
            --stroke-color: #fff;
            --stroke-dashoffset: 0;
        }

        .card__input:checked~.card__body .card__body-cover:after {
            --opacity-bg: 0;
        }

        .card__input:checked~.card__body .card__body-cover-image {
            --filter-bg: grayscale(0);
        }

        .card__input:disabled~.card__body {
            cursor: not-allowed;
            opacity: 0.5;
        }

        .card__input:disabled~.card__body:active {
            --scale: 1;
        }

        .card__body {
            display: grid;
            grid-auto-rows: calc(var(--card-height) - var(--header-height)) auto;
            background: var(--background);
            height: var(--card-height);
            width: var(--card-width);
            border-radius: var(--card-radius);
            overflow: hidden;
            position: relative;
            cursor: pointer;
            box-shadow: var(--shadow, 0 4px 4px 0 rgba(0, 0, 0, 0.02));
            transition: transform var(--transition), box-shadow var(--transition);
            transform: scale(var(--scale, 1)) translateZ(0);
        }

        .card__body:active {
            --scale: 0.96;
        }

        .card__body-cover {
            --c-border: var(--card-radius) var(--card-radius) 0 0;
            --c-width: 100%;
            --c-height: 100%;
            position: relative;
            overflow: hidden;
        }

        .card__body-cover:after {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            width: var(--c-width);
            height: var(--c-height);
            border-radius: var(--c-border);
            background: linear-gradient(to bottom right, var(--background-image));
            mix-blend-mode: var(--blend-mode);
            opacity: var(--opacity-bg, 1);
            transition: opacity var(--transition) linear;
        }

        .card__body-cover-image {
            width: var(--c-width);
            height: var(--c-height);
            -o-object-fit: cover;
            object-fit: cover;
            border-radius: var(--c-border);
            filter: var(--filter-bg, grayscale(1));
            -webkit-clip-path: polygon(0% 0%, 100% 0%, var(--x-y1, 100% 90%), var(--x-y2, 67% 83%), var(--x-y3, 33% 90%), var(--x-y4, 0% 85%));
            clip-path: polygon(0% 0%, 100% 0%, var(--x-y1, 100% 90%), var(--x-y2, 67% 83%), var(--x-y3, 33% 90%), var(--x-y4, 0% 85%));
        }

        .card__body-cover-checkbox {
            background: var(--check-bg, var(--background-checkbox));
            border: 2px solid var(--check-border, #fff);
            position: absolute;
            right: 10px;
            top: 10px;
            z-index: 1;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            opacity: var(--check-opacity, 0);
            transition: transform var(--transition), opacity calc(var(--transition) * 1.2) linear;
            transform: scale(var(--check-scale, 0));
        }

        .card__body-cover-checkbox--svg {
            width: 13px;
            height: 11px;
            display: inline-block;
            vertical-align: top;
            fill: none;
            margin: 7px 0 0 5px;
            stroke: var(--stroke-color, #fff);
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
            stroke-dasharray: 16px;
            stroke-dashoffset: var(--stroke-dashoffset, 16px);
            transition: stroke-dashoffset 0.4s ease var(--transition);
        }

        .card__body-header {
            height: var(--header-height);
            background: var(--background);
            padding: 0 10px 10px 10px;
        }

        .card__body-header-title {
            color: var(--text-headline);
            font-weight: 700;
            /* margin-bottom: 8px; */
        }

        .card__body-header-subtitle {
            color: var(--text-color);
            font-weight: 500;
            font-size: 13px;
        }

        html {
            box-sizing: border-box;
            -webkit-font-smoothing: antialiased;
        }

        * {
            box-sizing: inherit;
        }

        *:after {
            box-sizing: inherit;
        }

        body {
            min-height: 100vh;
            /* display: flex; */
            font-family: "Inter", Arial;
            justify-content: center;
            align-items: center;
            background: #fafafa;
            color: #000;
        }

        body .socials {
            position: fixed;
            display: flex;
            right: 20px;
            bottom: 20px;
        }

        body .socials>a {
            display: block;
            height: 28px;
            margin-left: 15px;
        }

        body .socials>a.dribbble img {
            height: 28px;
        }

        body .socials>a.twitter svg {
            width: 32px;
            height: 32px;
            fill: #1da1f2;
        }

        body .grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 1rem;
            padding: 40px;
        }
    </style>

    <link rel="stylesheet" href="sweetalert2.min.css">
</head>

<body>
    <input type="hidden" name="roomId" value="{{ $roomId }}">
    <div class="grid">
        @foreach($items as $item)
        <label class="card">
            <input class="card__input" type="checkbox" id="item_{{ $item->id }}" />
            <div class="card__body">
                <div class="card__body-cover">
                    <img class="card__body-cover-image" src="{{ asset('upload/'.$item->itm_img) }}" />
                    <span class="card__body-cover-checkbox">
                        <svg class="card__body-cover-checkbox--svg" viewBox="0 0 12 10">
                            <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                        </svg>
                    </span>
                </div>
                <header class="card__body-header">
                    <h6 class="card__body-header-title" style="margin-bottom: 0;">{{$item->itm_item_name}}</h6>
                    <p class="card__body-header-subtitle">Rs. {{$item->itm_item_price}}</p>
                </header>
            </div>
        </label>
        @endforeach
    </div>
    <a href="" class="btn btn-success" style="float: right;margin-right: 25px;margin-bottom: 50px;">Place Order</a>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="sweetalert2.min.js"></script>

<script>

</script>

</html>