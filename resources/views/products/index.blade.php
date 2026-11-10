@extends('layouts.app')

@section('content')
<style>
    /* Modal Overlay & Card Styling Extensions */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.75);
        backdrop-filter: blur(5px);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        padding: 1.5rem;
    }

    .modal-overlay.active {
        display: flex;
    }

    .modal-content {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 16px;
        max-width: 520px;
        width: 100%;
        max-height: 90vh;
        overflow-y: auto;
        padding: 2rem;
        position: relative;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
        animation: modalFadeIn 0.25s ease-out;
    }

    @keyframes modalFadeIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }

    .modal-close {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: transparent;
        border: none;
        color: var(--text-muted);
        font-size: 1.5rem;
        cursor: pointer;
        line-height: 1;
        padding: 4px;
    }

    .modal-close:hover {
        color: var(--text-main);
    }

    /* Product Card Hover Animation */
    .product-card {
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease !important;
    }

    .product-card:hover {
        transform: translateY(-6px);
        border-color: var(--accent) !important;
        box-shadow: 0 16px 30px rgba(0, 0, 0, 0.4), 0 0 15px rgba(204, 255, 0, 0.12) !important;
    }
</style>

<div style="max-width: 1200px; margin: 0 auto;">

    <!-- HERO SECTION -->
    <div class="card" style="margin-bottom: 2.5rem; text-align: center; padding: 3.5rem 2rem; position: relative; overflow: hidden; border: 1px solid var(--border);">
        <div style="max-width: 700px; margin: 0 auto;">
            <div style="display: inline-block; background: rgba(204, 255, 0, 0.1); border: 1px solid var(--accent); padding: 6px 16px; border-radius: 50px; color: var(--accent); font-weight: 700; font-size: 0.85rem; margin-bottom: 1.25rem; letter-spacing: 1px;">
                ⚡ WELCOME TO XMM
            </div>

            <h1 style="font-size: 2.75rem; font-weight: 800; line-height: 1.2; margin-bottom: 1rem; color: var(--text-main);">
                Find Your Ideal Phone for <span style="color: var(--accent);">Casual</span>, <span style="color: var(--accent);">Gaming</span> & Heavy Workloads.
            </h1>

            <p style="color: var(--text-muted); font-size: 1.05rem; line-height: 1.6; margin-bottom: 2rem;">
                Explore top-tier mobile devices engineered for peak performance, smooth daily operation, and gaming excellence.
            </p>

            <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
                <a href="#catalog" class="btn btn-primary" style="padding: 12px 28px; font-size: 1rem;">Explore Catalog</a>
                @guest
                    <a href="{{ route('register') }}" class="btn btn-outline" style="padding: 12px 28px; font-size: 1rem;">Join XMM</a>
                @endguest
            </div>
        </div>
    </div>

    <!-- CATEGORY FILTER BAR -->
    <div id="catalog" class="card" style="margin-bottom: 2rem; padding: 1.25rem 2rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
        <h3 style="color: var(--text-main); font-size: 1.25rem; font-weight: 700;">Catalog Items</h3>
        
        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
            <a href="{{ route('products.index') }}" class="btn {{ !request('category') ? 'btn-primary' : 'btn-outline' }}">All</a>
            <a href="{{ route('products.index', ['category' => 'Casual']) }}" class="btn {{ request('category') == 'Casual' ? 'btn-primary' : 'btn-outline' }}">Casual</a>
            <a href="{{ route('products.index', ['category' => 'Gaming']) }}" class="btn {{ request('category') == 'Gaming' ? 'btn-primary' : 'btn-outline' }}">Gaming</a>
            <a href="{{ route('products.index', ['category' => 'Heavy Usage']) }}" class="btn {{ request('category') == 'Heavy Usage' ? 'btn-primary' : 'btn-outline' }}">Heavy Usage</a>
        </div>
    </div>

    <!-- PRODUCT GRID WITH HOVER CARDS -->
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 25px;">
        @forelse($products as $product)
            <div class="card product-card" style="display: flex; flex-direction: column; justify-content: space-between; padding: 1.5rem;">
                <div>
                    <div style="background: var(--bg-input); border-radius: 12px; padding: 15px; margin-bottom: 1.25rem; text-align: center; border: 1px solid var(--border);">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" style="width: 100%; height: 200px; object-fit: contain;">
                    </div>
                    
                    <span style="font-size: 0.75rem; background: rgba(204, 255, 0, 0.15); color: var(--accent); border: 1px solid var(--accent); padding: 4px 10px; border-radius: 20px; font-weight: 700;">
                        {{ $product->category }}
                    </span>

                    <h4 style="margin-top: 12px; font-size: 1.2rem; font-weight: 700; color: var(--text-main);">{{ $product->title }}</h4>
                    <p style="color: var(--text-muted); font-size: 0.875rem;">{{ $product->brand }}</p>
                    <p style="margin-top: 12px; font-weight: 800; font-size: 1.35rem; color: var(--accent);">${{ number_format($product->price, 2) }}</p>
                </div>

                <!-- CARD ACTION BUTTONS -->
                <div style="margin-top: 1.25rem; border-top: 1px solid var(--border); padding-top: 1rem; display: flex; flex-direction: column; gap: 8px;">
                    <button type="button" class="btn btn-outline" style="width: 100%;" onclick="openModal('modal-{{ $product->id }}')">
                        More
                    </button>

                    @auth
                        @if(auth()->user()->role === 1)
                            <div style="display: flex; gap: 10px;">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-outline" style="flex: 1;">Edit</a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="flex: 1;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="width: 100%;" onclick="return confirm('Delete this product?')">Delete</button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- PRODUCT DETAILS MODAL -->
            <div id="modal-{{ $product->id }}" class="modal-overlay" onclick="closeModalOnOverlay(event, 'modal-{{ $product->id }}')">
                <div class="modal-content">
                    <button type="button" class="modal-close" onclick="closeModal('modal-{{ $product->id }}')">&times;</button>
                    
                    <div style="background: var(--bg-input); border-radius: 12px; padding: 20px; margin-bottom: 1.25rem; text-align: center; border: 1px solid var(--border);">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" style="max-width: 100%; height: 240px; object-fit: contain;">
                    </div>

                    <span style="font-size: 0.75rem; background: rgba(204, 255, 0, 0.15); color: var(--accent); border: 1px solid var(--accent); padding: 4px 10px; border-radius: 20px; font-weight: 700;">
                        {{ $product->category }}
                    </span>

                    <h3 style="margin-top: 12px; font-size: 1.5rem; font-weight: 800; color: var(--text-main);">{{ $product->title }}</h3>
                    <p style="color: var(--text-muted); font-size: 0.95rem; margin-bottom: 1rem;">Brand: <strong>{{ $product->brand }}</strong></p>
                    
                    <div style="border-top: 1px solid var(--border); border-bottom: 1px solid var(--border); padding: 1rem 0; margin-bottom: 1.25rem;">
                        <h5 style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.5px;">Product Description & Specs</h5>
                        <p style="color: var(--text-main); font-size: 0.95rem; line-height: 1.6; white-space: pre-line;">
                            {{ $product->description ?? 'No extra details provided for this device.' }}
                        </p>
                    </div>

                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <span style="font-size: 0.8rem; color: var(--text-muted); display: block;">Price</span>
                            <span style="font-weight: 800; font-size: 1.6rem; color: var(--accent);">${{ number_format($product->price, 2) }}</span>
                        </div>
                        <button type="button" class="btn btn-outline" onclick="closeModal('modal-{{ $product->id }}')">Close</button>
                    </div>
                </div>
            </div>
        @empty
            <div class="card" style="grid-column: 1 / -1; text-align: center; padding: 50px;">
                <p style="color: var(--text-muted); font-size: 1rem;">No phones currently available in this category.</p>
            </div>
        @endforelse
    </div>

</div>

<!-- MODAL CONTROLLER SCRIPT -->
<script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.remove('active');
        document.body.style.overflow = 'auto';
    }

    function closeModalOnOverlay(event, modalId) {
        if (event.target.classList.contains('modal-overlay')) {
            closeModal(modalId);
        }
    }
</script>
@endsection