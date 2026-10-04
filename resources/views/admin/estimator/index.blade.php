@extends('admin.layouts.app')

@section('page-title', 'Cost Estimator')

@section('content')
    <div class="page-header">
        <h1>Cost Estimator Settings</h1>
        <a href="{{ route('admin.estimator.type.create') }}" class="btn btn-primary">+ Add New Type</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @forelse($types as $type)
        <div class="estimator-type-card">

            {{-- Type Header --}}
            <div class="type-header">
                <div class="type-title">
                    <span class="type-icon">{{ $type->icon }}</span>
                    <strong>{{ $type->name }}</strong>
                    <span class="badge {{ $type->is_active ? 'badge-success' : 'badge-draft' }}">
                        {{ $type->is_active ? 'Active' : 'Inactive' }}
                    </span>
                    <small style="color:#888;">Base Price: PKR {{ number_format($type->base_price) }}</small>
                </div>
                <div class="type-actions">
                    <a href="{{ route('admin.estimator.type.edit', $type) }}" class="btn-edit">Edit Type</a>
                    <form method="POST" action="{{ route('admin.estimator.type.destroy', $type) }}"
                          style="display:inline;" onsubmit="return confirm('Delete this type and all its packages/addons?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="padding:7px 16px;font-size:13px;">Delete</button>
                    </form>
                </div>
            </div>

            {{-- ═══ PACKAGES SECTION ═══ --}}
            <div class="section-block">
                <div class="section-heading">
                    <span>📦 Packages</span>
                    <button class="btn-toggle" onclick="toggleSection('pkg-{{ $type->id }}')">+ Add / Manage</button>
                </div>

                <div id="pkg-{{ $type->id }}" class="section-body">

                    @forelse($type->packages as $pkg)
                        <div class="item-row" style="flex-direction:column; align-items:stretch;">
                            <form method="POST" action="{{ route('admin.estimator.package.update', [$type, $pkg]) }}" class="item-form" style="flex-direction:column; gap:10px;">
                                @csrf @method('PUT')
                                <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap;">
                                    <input type="text"   name="name"        class="fc fc-name"  value="{{ $pkg->name }}"  placeholder="Package name" required>
                                    <input type="number" name="price"       class="fc fc-price" value="{{ $pkg->price }}" placeholder="Price" min="0" required>
                                    <label class="per-head-label">
                                        <input type="checkbox" name="per_head" {{ $pkg->per_head ? 'checked' : '' }}>
                                        Per Head
                                    </label>
                                    <input type="hidden" name="order" value="{{ $pkg->order }}">
                                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                                    <button type="button" class="btn btn-sm btn-danger"
                                        onclick="
                                            if(confirm('Delete this package?')) {
                                                this.closest('.item-row').querySelector('.del-pkg-form').submit();
                                            }
                                        ">✕</button>
                                </div>
                                <input type="text" name="description" class="fc" style="width:100%;"
                                       value="{{ $pkg->description }}" placeholder="Description e.g. Standard stage, lighting, and seating">
                            </form>
                            <form class="del-pkg-form" method="POST" action="{{ route('admin.estimator.package.destroy', [$type, $pkg]) }}" style="display:none;">
                                @csrf @method('DELETE')
                            </form>
                        </div>
                    @empty
                        <p class="empty-note">No packages yet.</p>
                    @endforelse

                    {{-- Add New Package --}}
                    <div class="add-new-row">
                        <strong style="font-size:13px;color:#D4A853;">+ New Package</strong>
                        <form method="POST" action="{{ route('admin.estimator.package.store', $type) }}" style="margin-top:10px; display:flex; flex-direction:column; gap:8px;">
                            @csrf
                            <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap;">
                                <input type="text"   name="name"  class="fc fc-name"  placeholder="Package name e.g. Basic Decor" required>
                                <input type="number" name="price" class="fc fc-price" placeholder="Price e.g. 1200" min="0" required>
                                <label class="per-head-label">
                                    <input type="checkbox" name="per_head" checked>
                                    Per Head
                                </label>
                                <input type="hidden" name="order" value="0">
                                <button type="submit" class="btn btn-sm btn-success">Add</button>
                            </div>
                            <input type="text" name="description" class="fc" style="width:100%;"
                                   placeholder="Description e.g. Standard stage, lighting, and seating">
                        </form>
                    </div>

                </div>{{-- end section-body --}}
            </div>

            {{-- ═══ ADD-ONS SECTION ═══ --}}
            <div class="section-block" style="margin-top:4px;">
                <div class="section-heading" style="background:#f0f8f0;">
                    <span>➕ Add-ons</span>
                    <button class="btn-toggle" onclick="toggleSection('addon-{{ $type->id }}')">+ Add / Manage</button>
                </div>

                <div id="addon-{{ $type->id }}" class="section-body">

                    {{-- Existing Add-ons --}}
                    @forelse($type->addons as $addon)
                        <div class="item-row">
                            <form method="POST" action="{{ route('admin.estimator.addon.update', [$type, $addon]) }}" class="item-form">
                                @csrf @method('PUT')
                                <input type="text"   name="name"  class="fc fc-name"  value="{{ $addon->name }}"  placeholder="Add-on name" required>
                                <input type="number" name="price" class="fc fc-price" value="{{ $addon->price }}" placeholder="Price" min="0" required>
                                <label class="per-head-label">
                                    <input type="checkbox" name="is_active" {{ $addon->is_active ? 'checked' : '' }}>
                                    Active
                                </label>
                                <input type="hidden" name="order" value="{{ $addon->order }}">
                                <button type="submit" class="btn btn-sm btn-primary">Save</button>
                            </form>
                            <form method="POST" action="{{ route('admin.estimator.addon.destroy', [$type, $addon]) }}"
                                  onsubmit="return confirm('Delete this add-on?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">✕</button>
                            </form>
                        </div>
                    @empty
                        <p class="empty-note">No add-ons yet.</p>
                    @endforelse

                    {{-- Add New Add-on --}}
                    <div class="add-new-row">
                        <strong style="font-size:13px;color:#27ae60;">+ New Add-on</strong>
                        <form method="POST" action="{{ route('admin.estimator.addon.store', $type) }}" class="item-form" style="margin-top:8px;">
                            @csrf
                            <input type="text"   name="name"  class="fc fc-name"  placeholder="Add-on name e.g. Live BBQ Grill" required>
                            <input type="number" name="price" class="fc fc-price" placeholder="Price e.g. 50000" min="0" required>
                            <label class="per-head-label">
                                <input type="checkbox" name="is_active" checked>
                                Active
                            </label>
                            <input type="hidden" name="order" value="0">
                            <button type="submit" class="btn btn-sm btn-success">Add</button>
                        </form>
                    </div>

                </div>{{-- end section-body --}}
            </div>

        </div>{{-- end estimator-type-card --}}
    @empty
        <div class="data-table">
            <p style="text-align:center;padding:40px;">No estimator types yet.
                <a href="{{ route('admin.estimator.type.create') }}">Create one →</a>
            </p>
        </div>
    @endforelse
@endsection

@section('styles')
<style>
    /* ── Page Header ── */
    .page-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:30px; }
    .page-header h1 { font-size:26px; font-weight:800; color:#1a1a2e; }

    /* ── Type Card ── */
    .estimator-type-card {
        background:#fff;
        border:1px solid #e8e8e8;
        border-radius:14px;
        padding:20px 24px;
        margin-bottom:24px;
        box-shadow:0 2px 10px rgba(0,0,0,0.05);
    }

    /* ── Type Header ── */
    .type-header { display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px; margin-bottom:16px; }
    .type-title  { display:flex; align-items:center; gap:10px; font-size:16px; }
    .type-icon   { font-size:22px; }
    .type-actions{ display:flex; gap:10px; align-items:center; flex-wrap:wrap; }

    /* ── Section Block (packages / addons) ── */
    .section-block { border:1px solid #eee; border-radius:10px; overflow:hidden; margin-top:12px; }
    .section-heading {
        display:flex; justify-content:space-between; align-items:center;
        background:#fafafa; padding:10px 16px;
        font-weight:700; font-size:14px; color:#333;
    }
    .section-body { padding:14px 16px; }

    /* ── Each Item Row ── */
    .item-row {
        display:flex; align-items:center; gap:8px;
        padding:8px 0;
        border-bottom:1px solid #f0f0f0;
    }
    .item-row:last-child { border-bottom:none; }

    .item-form { display:flex; align-items:center; gap:8px; flex:1; flex-wrap:wrap; }

    /* ── Form Controls ── */
    .fc {
        padding:8px 11px; border:1px solid #ddd; border-radius:8px;
        font-size:13px; outline:none;
    }
    .fc:focus { border-color:#D4A853; }
    .fc-name  { flex:2; min-width:160px; }
    .fc-price { width:120px; }

    .per-head-label {
        display:flex; align-items:center; gap:5px;
        font-size:13px; color:#555; white-space:nowrap; cursor:pointer;
    }

    /* ── Add New Row ── */
    .add-new-row {
        background:#fffdf5; border:1px dashed #D4A853;
        border-radius:8px; padding:12px 14px; margin-top:12px;
    }

    /* ── Buttons ── */
    .btn-toggle {
        background:transparent; border:1px solid #D4A853; color:#D4A853;
        padding:5px 14px; border-radius:6px; font-size:12px; cursor:pointer;
    }
    .btn-toggle:hover { background:#D4A853; color:#fff; }

    .btn-sm { padding:7px 14px; font-size:13px; border-radius:7px; border:none; cursor:pointer; font-weight:600; }
    .btn-primary { background:#D4A853; color:#fff; }
    .btn-primary:hover { background:#b8882e; }
    .btn-success { background:#27ae60; color:#fff; }
    .btn-success:hover { background:#1e8449; }
    .btn-danger  { background:#e74c3c; color:#fff; }
    .btn-danger:hover  { background:#c0392b; }

    .btn-edit {
        background:#1a1a2e; color:#fff; padding:7px 16px;
        border-radius:8px; text-decoration:none; font-size:13px; font-weight:600;
    }
    .btn-edit:hover { background:#2c2c54; }

    .empty-note { color:#aaa; font-size:13px; margin:6px 0; }
</style>
@endsection

@section('scripts')
<script>
    // Toggle show/hide the packages or addons section
    function toggleSection(id) {
        const el = document.getElementById(id);
        if (el.style.display === 'none') {
            el.style.display = 'block';
        } else {
            el.style.display = 'none';
        }
    }
</script>
@endsection
