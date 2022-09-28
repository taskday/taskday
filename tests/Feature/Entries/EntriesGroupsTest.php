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

test('an entries can be have groups', function () {
    $board = Board::factory()->owned()->create();

    // Aggiungere un campo Progress
    // $board->fields()->create([
    //     'title' => 'Progress',
    //     'type' => 'progress',
    // ]);

    // // il campo progress ha dei campi definiti
    // interface Group {}

    // // posso usare i valori in una kanban board
    // $groups = taskday()
    //     ->fieldTypes()
    //     ->groups()
    //     ->for($field);

    // Aggiungere un campo Priorità
    // il campo Priorità ha dei campi definiti
    // posso usare i valori in una kanban board

    // implements HasOneValue
    // implements HasManeyValues
});
