<div wire:loading>
    <style>
    .loader {
        position: fixed;
        top: 50%;
        left: 50%;
        z-index: 9999;
        transform: translate(-50%, -50%);
        border-top-color: #0da5e9;
        -webkit-animation: spinner 1.5s linear infinite;
        animation: spinner 1.5s linear infinite;
    }

    @-webkit-keyframes spinner {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spinner {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    </style>
    <div class="fixed inset-0 z-50 w-full h-screen opacity-75 bg-gray-50"></div>
    <div class="w-40 h-40 ease-linear border-4 rounded-full border-light-blue-200 loader"></div>
</div>