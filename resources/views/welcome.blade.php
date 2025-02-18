<!DOCTYPE html>
<html lang="en">
<x-header/>
<body class="bg-light">
  <div class="container py-4">
    <!-- Logo -->
    <x-logo/>

    <!-- Buttons -->
    <div class="d-flex justify-content-center gap-3 mb-4">
      <button class="btn btn-primary px-5" data-bs-toggle="modal" data-bs-target="#coinTossModal">Toss</button>
      <a href="{{ route('game.create') }}" class="btn btn-success px-5">Start Game</a>
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

     <h1 class="text-center mb-4" style="color: #2c3e50;">Tournament List</h1>

    <!-- Tournament List Table -->
    <table class="tournament-table table">
      <thead>
        <tr>
          <th>Date</th>
          <th>Winner</th>
          <th>View</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>2023-10-01</td>
          <td>Player 1</td>
          <td>
            <button class="btn btn-view-details">
              <i class="fas fa-eye"></i> 
            </button>
          </td>
        </tr>
        <tr>
          <td>2023-09-25</td>
          <td>Player 3</td>
          <td>
            <button class="btn btn-view-details">
              <i class="fas fa-eye"></i> 
            </button>
          </td>
        </tr>
        <tr>
          <td>2023-09-18</td>
          <td>Player 5</td>
          <td>
            <button class="btn btn-view-details">
              <i class="fas fa-eye"></i> 
            </button>
          </td>
        </tr>
        <!-- Add more rows as needed -->
      </tbody>
    </table>
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