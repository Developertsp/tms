<?php

namespace App\Exports;

use App\Models\Task;
use Illuminate\Support\Facades\Config;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;

class TasksExport implements FromCollection, WithHeadings, WithMapping, WithTitle
{
    protected $tasks;

    public function __construct($tasks)
    {
        $this->tasks = $tasks;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Task::with('project', 'department', 'users', 'creator')->whereIn('id', $this->tasks)->get();
    }

    public function headings(): array
    {
        $headings = [
            '#',
            'Title',
            'Description',
            'Priority',
            'Status',
            'Start Date',
            'End Date',
            'Assigned To',
            'Deparment',
        ];

        return $headings;
    }

    public function map($task): array
    {
        // Determine status label and color
        $status = Config::get('constants.STATUS_LIST.' . $task->status);
        $cellColor = '';

        if ($task->status == 'Closed' && isset($task->end_date) && \Carbon\Carbon::parse($task->end_date)->isPast()) {
            $cellColor = 'red';
        } elseif ($task->status == 'Working') {
            $cellColor = 'blue';
        } elseif ($task->status == 'Assigned') {
            $cellColor = 'red';
        } elseif ($task->status == 'Closed') {
            $cellColor = 'green';
        }

        $row = [
            $task->id,
            $task->title,
            $task->description,
            Config::get('constants.PRIORITY_LIST.' . $task->priority),
            $status,
            $task->start_date,
            $task->end_date,
        ];

        if ($this->hasUsers($task)) {
            $assignedTo = $task->users->pluck('name')->implode(', ');
            $row[] = $assignedTo;
        }

        if ($this->hasDepartments($task)) {
            $department = $task->department->name; // Assuming relationship method exists
            $row[] = $department;
        }

        return $row;
    }

    public function title(): string
    {
        return 'Tasks'; // Title for the sheet
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Set header styling
                $event->sheet->getStyle('A1:H1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF'], // White text color
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '000000'], // Black background color
                    ],
                ]);

                // Apply conditional formatting based on status and end date
                $highestRow = $event->sheet->getHighestRow();
                for ($row = 2; $row <= $highestRow; $row++) {
                    $statusCell = 'E' . $row; // Status column
                    $endDateCell = 'G' . $row; // End Date column

                    $event->sheet->getStyle($statusCell)->applyFromArray([
                        'font' => [
                            'bold' => true,
                            'color' => ['rgb' => 'FFFFFF'], // White text color
                        ],
                        'fill' => [
                            'fillType' => Fill::FILL_SOLID,
                            'startColor' => ['rgb' => $this->getStatusColor($row)], // Custom status color
                        ],
                    ]);

                    // Highlight row if status is 'Closed' and end date is past
                    if ($this->tasks[$row - 2]->status == 'Closed' && \Carbon\Carbon::parse($this->tasks[$row - 2]->end_date)->isPast()) {
                        $event->sheet->getStyle('A' . $row . ':H' . $row)->applyFromArray([
                            'fill' => [
                                'fillType' => Fill::FILL_SOLID,
                                'startColor' => ['rgb' => 'FF0000'], // Red background color
                            ],
                            'font' => [
                                'bold' => true,
                                'color' => ['rgb' => 'FFFFFF'], // White text color
                            ],
                        ]);
                    }
                }
            },
        ];
    }

    /**
     * Check if tasks have users assigned.
     *
     * @param \App\Models\Task|null $task
     * @return bool
     */
    private function hasUsers($task = null)
    {
        if ($task && $task->relationLoaded('users')) {
            return $task->users->isNotEmpty();
        }

        return false;
    }

    /**
     * Check if tasks have departments assigned.
     *
     * @param \App\Models\Task|null $task
     * @return bool
     */
    private function hasDepartments($task = null)
    {
        if ($task && $task->relationLoaded('department')) {
            return $task->department !== null;
        }

        return false;
    }

    /**
     * Get status color based on task status.
     *
     * @param int $row
     * @return string
     */
    private function getStatusColor($row)
    {
        $task = $this->tasks[$row - 2]; // Adjust index for tasks array
        $status = $task->status;

        if ($status == 'Working') {
            return '0000FF'; // Blue color
        } elseif ($status == 'Assigned') {
            return 'FF0000'; // Red color
        } elseif ($status == 'Closed') {
            return '008000'; // Green color
        }

        return 'FFFFFF'; // Default white color
    }
}

