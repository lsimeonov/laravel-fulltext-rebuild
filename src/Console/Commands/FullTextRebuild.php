<?php


namespace lsimeonov\FullTextRebuild\Console\Commands;


use Illuminate\Console\Command;

class FullTextRebuild extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mysql:fulltext:rebuild {--c|connection}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rebuild fulltext indexes';


    /**
     * Handle the command.
     */
    public function handle()
    {
        $connection = $this->option('connection');

        $schema = \DB::connection($connection)->getDatabaseName();

        $result = \DB::select("SELECT index_name AS `index`, group_concat(column_name) AS `columns`, TABLE_NAME AS `table`
                               FROM information_Schema.STATISTICS
                               WHERE table_schema = ?
                               AND index_type = 'FULLTEXT'
                               GROUP BY `index`, `table`"
            , [$schema]
        );

        $bar = $this->output->createProgressBar(count($result));

        foreach ($result as $item) {

            \DB::unprepared("ALTER TABLE $item->table DROP INDEX $item->index");

            $columnNames = explode(',', $item->columns);
            foreach ($columnNames as &$name) {
                $name = '`' . $name . '`';
            }
            $columnNames = implode(',', $columnNames);

            \DB::unprepared("ALTER TABLE $item->table ADD FULLTEXT $item->index ($columnNames)");
            $bar->advance();
        }

        $bar->finish();

        $this->info('Fulltext indexes were rebuild successfully');
    }
}