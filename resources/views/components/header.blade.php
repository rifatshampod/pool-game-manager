<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Game Leaderboard</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome for icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  {{-- Local CSS  --}}
  <link href="/assets/style.css" rel="stylesheet" type="text/css"/>
  <script>
  if ('serviceWorker' in navigator) {
      navigator.serviceWorker.register('/serviceworker.js')
          .then(reg => console.log("Service Worker Registered", reg))
          .catch(err => console.log("Service Worker Not Registered", err));
  }
  </script>

  <link rel="manifest" href="{{ asset('manifest.json') }}">
</head>