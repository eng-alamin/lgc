<div>
    <div class="header-space"></div>

    <div class="container">
        <div class="row g-4">
            <section id="profile" class="mb-5">
                <h4>Profile & Personal Details</h4>
                <div class="card shadow p-3">
                    <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
                    <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                    <p><strong>Phone:</strong> {{ auth()->user()->phone ?? '-' }}</p>
                </div>
            </section>
        </div>
    </div>
</div>