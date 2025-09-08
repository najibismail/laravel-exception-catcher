<?php

namespace NajibIsmail\LaravelExceptionCatcher\Console\Commands;

use Illuminate\Console\Command;

class TestExceptionCatcher extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exception:test {type?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test the Exception Catcher package by throwing various exceptions';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $type = $this->argument('type') ?? 'runtime';

        $this->info('🧪 Testing Laravel Exception Catcher package...');
        $this->line('');

        try {
            switch ($type) {
                case 'runtime':
                    $this->info('📊 Throwing a RuntimeException...');
                    throw new \RuntimeException('This is a test RuntimeException for the Exception Catcher package');

                case 'invalid':
                    $this->info('🔧 Throwing an InvalidArgumentException...');
                    throw new \InvalidArgumentException('This is a test InvalidArgumentException for the Exception Catcher package');

                case 'custom':
                    $this->info('⚙️ Throwing a custom exception...');
                    throw new \Exception('This is a custom test exception for the Exception Catcher package');

                case 'db':
                    $this->info('💾 Simulating a database exception...');
                    throw new \PDOException('Database connection failed (test exception for the Exception Catcher package)');

                case 'fatal':
                    $this->info('💥 Simulating a fatal error...');
                    throw new \Error('This is a test fatal error for the Exception Catcher package');

                case 'validation':
                    $this->info('🔍 Simulating a validation exception...');
                    throw new \Illuminate\Validation\ValidationException(
                        validator([], ['test' => 'required'])
                    );

                case 'http':
                    $this->info('🌐 Simulating an HTTP exception...');
                    throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('Page not found (test exception)');

                default:
                    $this->error('❌ Invalid exception type.');
                    $this->line('');
                    $this->info('Available types:');
                    $this->line('  • runtime     - RuntimeException');
                    $this->line('  • invalid     - InvalidArgumentException');
                    $this->line('  • custom      - Generic Exception');
                    $this->line('  • db          - PDOException (database)');
                    $this->line('  • fatal       - Error (fatal error)');
                    $this->line('  • validation  - ValidationException');
                    $this->line('  • http        - NotFoundHttpException');
                    $this->line('');
                    $this->line('Usage: php artisan exception:test [type]');
                    return Command::FAILURE;
            }
        } catch (\Throwable $e) {
            $this->line('');
            $this->error('🚨 Exception caught: ' . $e->getMessage());
            $this->line('');
            $this->info('✅ The exception should have been processed and emailed to the configured recipients.');
            $this->line('📧 Check your email for the exception notification.');
            $this->line('');
            $this->comment('💡 Tip: You can also test via web route: /exception-test/{type}');
            
            // Re-throw to let Laravel's exception handler process it
            // This will trigger our SendsExceptionEmails trait
            throw $e;
        }

        return Command::SUCCESS;
    }
}
