<!DOCTYPE html>
<html lang="en">
<x-header/>
<body class="bg-light">
  <div class="container py-4">
    <!-- Logo -->
    <x-logo/>

    <!-- Buttons -->
    <div class="d-flex justify-content-center gap-3 mb-4">
      {{-- <button class="btn btn-primary px-5" data-bs-toggle="modal" data-bs-target="#coinTossModal">Toss</button> --}}
      <a href="{{ route('game.create') }}" class="btn btn-success px-5 py-3 w-100">Start Game</a>
    </div>

    <!-- Add Player Button -->
    <button type="button" class="btn btn-warning mb-4 w-100" data-bs-toggle="modal" data-bs-target="#addPlayerModal">
        <i class="fas fa-plus"></i> Add Player
    </button>

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
            @foreach ($leaderboard as $index => $player)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $player->name }}</td>
                    <td>{{ $player->total_points }}</td>
                </tr>
            @endforeach
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
          @foreach ($tournaments as $tournament)
              <tr>
                  <td>{{ $tournament->date }}</td>
                  <td>
                      @if ($tournament->winner)
                          {{ $tournament->winner->name }}
                      @else
                          N/A
                      @endif
                  </td>
                  <td>
                      <a href="{{ route('tournament.show', $tournament->id) }}" class="btn btn-view-details">
                          <i class="fas fa-eye"></i>
                      </a>
                  </td>
              </tr>
          @endforeach
      </tbody>
  </table>
  </div>

  <!-- Add Player Modal -->
  <div class="modal fade" id="addPlayerModal" tabindex="-1" aria-labelledby="addPlayerModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="addPlayerModalLabel">Add New Player</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form id="addPlayerForm" action="{{ route('player.store') }}" method="POST">
                      @csrf
                      <div class="mb-3">
                          <label for="playerName" class="form-label">Player Name</label>
                          <input type="text" class="form-control" id="playerName" name="name" required>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Save Player</button>
                      </div>
                  </form>
              </div>
          </div>
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