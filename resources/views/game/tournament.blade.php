<!DOCTYPE html>
<html lang="en">
<x-header/>
  <body>
    <div class="container">
      <x-logo/>
      <h1 class="text-center mb-4" style="color: #2c3e50;">Tournament: {{ $game->date }}</h1>

      <!-- Winner Section -->
      @if ($winner)
        <div class="group text-center py-5" style="background-color: #2c3e50; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
          <h2 class="text-white mb-4"><i class="fas fa-trophy"></i> Tournament Winner</h2>
          <div class="winner-card d-inline-block p-4" style="background-color: #3498db; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            <h1 class="text-white mb-0" style="font-size: 3rem; font-weight: bold;">
              <i class="fas fa-crown"></i> {{ $winner->name }}
            </h1>
          </div>
        </div>
      @endif

      <!-- Group Stages -->
      @if ($hasGroupStageMatches)
        @foreach ($groups as $group)
          <div class="group">
            <h3><i class="fas fa-users"></i> {{ $group->name }}</h3>
            <table class="fixture-table table">
              <thead>
                <tr>
                  <th>#</th>
                  <th><i class="fa-regular fa-circle-dot"></i> P1</th>
                  <th>P2</th>
                  <th>Score</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($matches->where('round_id', 1)->where('group_id', $group->id) as $match)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $match->player1->name }}</td>
                    <td>{{ $match->player2->name }}</td>
                    <td>
                      @if ($match->scores)
                        {{ $match->scores }}
                      @else
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#scoreModal{{ $match->id }}">
                          <i class="fas fa-plus"></i> 
                        </button>
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endforeach
      @endif

      <!-- Semi-Final -->
      @if ($hasSemiFinalMatches)
        <div class="group">
          <h3><i class="fas fa-trophy"></i> Semi-Final</h3>
          <table class="fixture-table table">
            <thead>
              <tr>
                <th><i class="fa-regular fa-circle-dot"></i> P1</th>
                <th>P2</th>
                <th>Score</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($matches->where('round_id', 2) as $match)
                <tr>
                  <td>{{ $match->player1->name }}</td>
                  <td>{{ $match->player2->name }}</td>
                  <td>
                    @if ($match->scores->isNotEmpty())
                      {{ $match->scores->first()->player1_score }} - {{ $match->scores->first()->player2_score }}
                    @else
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#scoreModal{{ $match->id }}">
                        <i class="fas fa-plus"></i> 
                      </button>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif

      <!-- Final -->
      @if ($hasFinalMatch)
        <div class="group">
          <h3><i class="fas fa-trophy"></i> Final</h3>
          <table class="fixture-table table">
            <thead>
              <tr>
                <th><i class="fa-regular fa-circle-dot"></i> P1</th>
                <th>P2</th>
                <th>Score</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($matches->where('round_id', 3) as $match)
                <tr>
                  <td>{{ $match->player1->name }}</td>
                  <td>{{ $match->player2->name }}</td>
                  <td>
                    @if ($match->scores->isNotEmpty())
                      {{ $match->scores->first()->player1_score }} - {{ $match->scores->first()->player2_score }}
                    @else
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#scoreModal{{ $match->id }}">
                        <i class="fas fa-plus"></i> 
                      </button>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif

      <!-- Scoreboard -->
      {{-- <div class="group">
        <h3><i class="fas fa-chart-bar"></i> Scoreboard</h3>
        <table class="scoreboard-table table">
          <thead>
            <tr>
              <th>#</th>
              <th>Player</th>
              <th>Wins</th>
              <th>Losses</th>
              <th>Points</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($scoreboard as $index => $player)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $player['name'] }}</td>
                <td>{{ $player['wins'] }}</td>
                <td>{{ $player['losses'] }}</td>
                <td>{{ $player['points'] }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div> --}}
    </div>

    <!-- Score Modals -->
    @foreach ($matches as $match)
      <div class="modal fade" id="scoreModal{{ $match->id }}" tabindex="-1" aria-labelledby="scoreModal{{ $match->id }}Label" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="scoreModal{{ $match->id }}Label">Add Score for Match {{ $match->id }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{ route('match.updateScore', $match->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="player1_score" class="form-label">{{ $match->player1->name }} Score</label>
                  <input type="number" class="form-control" id="player1_score" name="player1_score" required>
                </div>
                <div class="mb-3">
                  <label for="player2_score" class="form-label">{{ $match->player2->name }} Score</label>
                  <input type="number" class="form-control" id="player2_score" name="player2_score" required>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save Score</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    @endforeach

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>