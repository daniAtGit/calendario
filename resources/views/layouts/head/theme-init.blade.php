<script>
    (() => {
        let savedTheme;
        try {
            savedTheme = localStorage.getItem('theme');
        } catch {
            // Il tema resta utilizzabile anche se il browser blocca lo storage.
        }
        const isDark = savedTheme === 'dark' ||
            (savedTheme !== 'light' && window.matchMedia('(prefers-color-scheme: dark)').matches);

        document.documentElement.classList.toggle('dark', isDark);
        document.documentElement.dataset.bsTheme = isDark ? 'dark' : 'light';
    })();
</script>
