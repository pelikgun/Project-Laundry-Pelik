        document.addEventListener("DOMContentLoaded", function () {
            const body = document.querySelector('body');
            const sidebar = body.querySelector('nav');
            const toggle = body.querySelector(".toggle");
            const modeSwitch = body.querySelector(".toggle-switch");
            const modeText = body.querySelector(".mode-text");

            // Ambil status sidebar dari local storage
            const isSidebarClosed = localStorage.getItem('sidebarClosed') === 'true';

            // Atur status sidebar sesuai dengan nilai dari local storage
            sidebar.classList.toggle("close", isSidebarClosed);

            // Tambahkan kelas 'initialized' untuk mencegah efek berkedip saat refresh
            body.classList.add("initialized");

            toggle.addEventListener("click", () => {
                sidebar.classList.toggle("close");
                // Simpan status sidebar ke local storage
                localStorage.setItem('sidebarClosed', sidebar.classList.contains("close"));
            });

            modeSwitch.addEventListener("click", () => {
                body.classList.toggle("dark");
                if (body.classList.contains("dark")) {
                    modeText.innerText = "Light mode";
                } else {
                    modeText.innerText = "Dark mode";
                }
            });

            // Optional: To close the sidebar when clicking outside of it
            document.addEventListener("click", (event) => {
                if (!event.target.closest('nav') && !event.target.closest('.toggle')) {
                    sidebar.classList.add("close");
                    // Simpan status sidebar ke local storage
                    localStorage.setItem('sidebarClosed', true);
                }
            });
        });