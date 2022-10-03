<?php

use Taskday\Models\Entry;
use Taskday\Models\Board;
use Taskday\Models\Field;

beforeEach(function () {
    $this->user = createUserAndlogin();
});

test('a board can be have many entries', function () {
    $board = Board::factory()->owned()->create();

    $entry = $this->user->createEntry([
        'title' => Entry::factory()->make()->title,
        'board_id' => $board->id,
    ]);

    expect($entry->board_id)->toBe($board->id);
    expect($board->entries)->toHaveCount(1);
});
