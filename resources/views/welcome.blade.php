<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Game Leaderboard</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Custom styles for better spacing */
    .logo {
      max-width: 250px;
    }
    .leaderboard-table {
      margin-top: 20px;
    }

    /* Coin flip animation */
    .coin {
      width: 200px;
      height: 200px;
      position: relative;
      transform-style: preserve-3d;
      animation: flip 1s ease-out;
    }
    .coin .side {
      width: 100%;
      height: 100%;
      position: absolute;
      backface-visibility: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 30px;
      font-weight: bold;
      border-radius: 50%;
    }
    .coin .heads {
      background-color: gold;
      transform: rotateY(0deg);
    }
    .coin .tails {
      background-color: silver;
      transform: rotateY(180deg);
    }
    @keyframes flip {
      0% {
        transform: rotateY(0deg);
      }
      50% {
        transform: rotateY(600deg); /* Multiple rotations for a realistic flip */
      }
      100% {
        transform: rotateY(0deg);
      }
    }
  </style>
</head>
<body class="bg-light">
  <div class="container py-4">
    <!-- Logo -->
    <div class="text-center mb-5">
      <img src="images/logo.svg" alt="Game Logo" class="logo">
      <hr>
    </div>

    <!-- Buttons -->
    <div class="d-flex justify-content-center gap-3 mb-4">
      <button class="btn btn-primary px-5" data-bs-toggle="modal" data-bs-target="#coinTossModal">Toss</button>
      <button class="btn btn-success px-5">Start Game</button>
    </div>

    <!-- Leaderboard Table -->
    <div class="text-center">
        <h3>Leaderboard</h3>
    </div>
    <div class="table-responsive leaderboard-table">
      <table class="table table-bordered table-hover shadow">
        <thead class="table-dark">
          <tr>
            <th scope="col">Position</th>
            <th scope="col">Player</th>
            <th scope="col">Points</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Player 1</td>
            <td>100</td>
          </tr>
          <tr>
            <td>2</td>
            <td>Player 2</td>
            <td>90</td>
          </tr>
          <tr>
            <td>3</td>
            <td>Player 3</td>
            <td>80</td>
          </tr>
          <tr>
            <td>4</td>
            <td>Player 4</td>
            <td>70</td>
          </tr>
          <tr>
            <td>5</td>
            <td>Player 5</td>
            <td>60</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Coin Toss Modal -->
  <div class="modal fade" id="coinTossModal" tabindex="-1" aria-labelledby="coinTossModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="coinTossModalLabel">Coin Toss Result</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
          <div class="coin">
            <div class="side heads">Heads</div>
            <div class="side tails">Tails</div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Function to simulate a coin toss
    function tossCoin() {
      const coin = document.querySelector('.coin');
      const heads = coin.querySelector('.heads');
      const tails = coin.querySelector('.tails');
      const result = Math.random() < 0.5 ? 'heads' : 'tails';

      // Reset animation
      coin.style.animation = 'none';
      void coin.offsetHeight; // Trigger reflow
      coin.style.animation = 'flip 1s ease-out';

      // Hide both sides initially
      heads.style.display = 'none';
      tails.style.display = 'none';

      // Update the result after animation
      setTimeout(() => {
        if (result === 'heads') {
          heads.style.display = 'flex';
        } else {
          tails.style.display = 'flex';
        }
      }, 1000); // Match the duration of the animation
    }

    // Trigger coin toss when the modal is shown
    const coinTossModal = document.getElementById('coinTossModal');
    coinTossModal.addEventListener('shown.bs.modal', tossCoin);
  </script>
</body>
</html>