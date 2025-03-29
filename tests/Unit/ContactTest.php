<?php

use App\Models\Contact;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseCount;

uses(TestCase::class, RefreshDatabase::class);

beforeEach(function() {
    test()->info('Starting test with fresh database...');
});

test('can create a contact with valid data', function () {
    $contactData = [
        'name' => 'John Doe',
        'phone_number' => '1234567890'
    ];
    
    $contact = Contact::create($contactData);
    test()->info('Contact created successfully');

    // Test database has the contact
    assertDatabaseHas('contacts', $contactData);
    test()->info('Contact found in database');

    // Test the attributes are correct
    expect($contact)
        ->name->toBe('John Doe')
        ->phone_number->toBe('1234567890');
    
    // Show total contacts
    assertDatabaseCount('contacts', 1);
    test()->info('Database has exactly 1 contact');
});

test('cannot create contact without name', function () {
    $this->expectException(QueryException::class);

    try {
        Contact::create([
            'phone_number' => '1234567890'
        ]);
    } catch (QueryException $e) {
        test()->info('Database error as expected: Name is required');
        throw $e;
    }
});

test('cannot create contact without phone number', function () {
    $this->expectException(QueryException::class);

    try {
        Contact::create([
            'name' => 'John Doe'
        ]);
    } catch (QueryException $e) {
        test()->info('Database error as expected: Phone number is required');
        throw $e;
    }
});

test('cannot create contact with duplicate phone number', function () {
    // Create first contact
    $firstContact = Contact::create([
        'name' => 'John Doe',
        'phone_number' => '1234567890'
    ]);
    test()->info('First contact created successfully');

    $this->expectException(QueryException::class);

    try {
        // Try to create second contact with same phone number
        Contact::create([
            'name' => 'Jane Doe',
            'phone_number' => '1234567890'
        ]);
    } catch (QueryException $e) {
        test()->info('Database error as expected: Phone number must be unique');
        throw $e;
    }
}); 