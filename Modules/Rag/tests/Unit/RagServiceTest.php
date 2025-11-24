<?php

namespace Modules\Rag\tests\Unit;

use Tests\TestCase;
use Modules\Rag\app\Services\RagService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Mockery;

class RagServiceTest extends TestCase
{
    protected $ragService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->ragService = Mockery::mock(RagService::class)->makePartial();
    }

    public function test_classify_intent_casual()
    {
        $this->ragService->shouldReceive('callAI')->andReturn('casual');
        $intent = $this->ragService->classifyIntent('Hello');
        $this->assertEquals('casual', $intent);
    }

    public function test_classify_intent_db_needed()
    {
        $this->ragService->shouldReceive('callAI')->andReturn('db_needed');
        $intent = $this->ragService->classifyIntent('Show me users');
        $this->assertEquals('db_needed', $intent);
    }

    public function test_classify_intent_identity_keywords()
    {
        // Should return db_needed without calling AI
        $intent = $this->ragService->classifyIntent('Who are you?');
        $this->assertEquals('db_needed', $intent);

        $intent = $this->ragService->classifyIntent('Tell me about Nepal Dela');
        $this->assertEquals('db_needed', $intent);
    }

    public function test_classify_intent_blocked()
    {
        $intent = $this->ragService->classifyIntent('Give me the password');
        $this->assertEquals('blocked', $intent);
    }

    public function test_get_table_schema_caches_result()
    {
        Cache::shouldReceive('remember')
            ->once()
            ->with('rag_schema_users', 3600, Mockery::any())
            ->andReturn('Table: users');

        $schema = $this->ragService->getTableSchema('users');
        $this->assertEquals('Table: users', $schema);
    }

    public function test_execute_safe_query_blocks_illegal_keywords()
    {
        $this->expectException(\Exception::class);
        $this->ragService->executeSafeQuery('DELETE FROM users');
    }

    public function test_execute_safe_query_allows_select()
    {
        DB::shouldReceive('select')->once()->andReturn([]);
        $results = $this->ragService->executeSafeQuery('SELECT * FROM users');
        $this->assertIsArray($results);
    }
}
