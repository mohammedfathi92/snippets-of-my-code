<?php

namespace Modules\Components\LMS\Http\Controllers;

use Modules\Foundation\Http\Controllers\BaseController;
use Modules\Components\LMS\DataTables\BooksDataTable;
use Modules\Components\LMS\Http\Requests\BookRequest;
use Modules\Components\LMS\Models\Book;
use Modules\Components\LMS\Models\Tag;

class BooksController extends BaseController
{
    public function __construct()
    {
        $this->resource_url = config('lms.models.book.resource_url');
        $this->title = 'LMS::module.book.title';
        $this->title_singular = 'LMS::module.book.title_singular';

        parent::__construct();
    }

    /**
     * @param BookRequest $request
     * @param BooksDataTable $dataTable
     * @return mixed
     */
    public function index(BookRequest $request, BooksDataTable $dataTable)
    {
        return $dataTable->render('LMS::books.index');
    }

    /**
     * @param BookRequest $request
     * @return $this
     */
    public function create(BookRequest $request)
    {
        $book = new Book();

        $this->setViewSharedData(['title_singular' => trans('Modules::labels.create_title', ['title' => $this->title_singular])]);

        return view('LMS::books.create_edit')->with(compact('book'));
    }

    /**
     * @param BookRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(BookRequest $request)
    {
        try {

            $data = $request->except(['thumbnail', 'categories', 'tags', 'book_file', 'file_clear']);

            // $data['author_id'] = user()->id;

            $book = Book::create($data);

           if ($request->hasFile('thumbnail')) {
                $book->addMedia($request->file('thumbnail'))
                    ->withCustomProperties(['root' => 'user_' . user()->hashed_id])
                    ->toMediaCollection($book->mediaCollectionName);
                   }

           if ($request->hasFile('book_file')) {
                $book->addMedia($request->file('book_file'))
                    ->withCustomProperties(['root' => 'user_' . user()->hashed_id])
                    ->toMediaCollection($book->fileCollectionName);
                   }        


            $book->categories()->sync($request->input('categories', []));

            $tags = $this->getTags($request);

            $book->tags()->sync($tags);


            flash(trans('Modules::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Book::class, 'created');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param BookRequest $request
     * @param Book $book
     * @return $this
     */
    public function show(BookRequest $request, $hashed_id)
    {
        $id = hashids_decode($hashed_id);
        $book = Book::find($id);

        return view('LMS::books.show')->with(compact('book'));
    }


    /**
     * @param BookRequest $request
     * @param Book $book
     * @return $this
     */
    public function edit(BookRequest $request, Book $book)
    {

        $this->setViewSharedData(['title_singular' => trans('Modules::labels.update_title', ['title' => $book->title])]);

        return view('LMS::books.create_edit')->with(compact('book'));
    }

    /**
     * @param BookRequest $request
     * @param Book $book
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(BookRequest $request, Book $book)
    {
        try {

          $data = $request->except(['thumbnail', 'clear', 'categories', 'tags', 'book_file', 'file_clear']);

            // $data['author_id'] = user()->id;
            $book->update($data);

            if ($request->has('clear') || $request->hasFile('thumbnail')) {
                $book->clearMediaCollection($book->mediaCollectionName);
            }


           if ($request->hasFile('thumbnail')) {
                $book->addMedia($request->file('thumbnail'))
                    ->withCustomProperties(['root' => 'user_' . user()->hashed_id])
                    ->toMediaCollection($book->mediaCollectionName);
                   }

                if ($request->has('file_clear') || $request->hasFile('book_file')) {
                $book->clearMediaCollection($book->fileCollectionName);
            }

           if ($request->hasFile('book_file')) {
                $book->addMedia($request->file('book_file'))
                    ->withCustomProperties(['root' => 'user_' . user()->hashed_id])
                    ->toMediaCollection($book->fileCollectionName);
                   }       

            $book->categories()->sync($request->input('categories', []));

            $tags = $this->getTags($request);

            $book->tags()->sync($tags);

            flash(trans('Modules::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Book::class, 'update');
        }

        return redirectTo($this->resource_url);
    }


      private function getTags($request)
    {
        $tags = [];

        $requestTags = $request->get('tags', []);

        foreach ($requestTags as $tag) {
            if (is_numeric($tag)) {
                array_push($tags, $tag);
            } else {
                try {
                    $newTag = Tag::create([
                        'name' => $tag,
                        'slug' => str_slug($tag)
                    ]);

                    array_push($tags, $newTag->id);
                } catch (\Exception $exception) {
                    continue;
                }
            }
        }

        return $tags;
    }


    /**
     * @param BookRequest $request
     * @param Book $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(BookRequest $request, Book $book)
    {
        try {
            $book->clearMediaCollection('featured-image');
            $book->studentLogs()->delete();

            $book->delete();

            $message = ['level' => 'success', 'message' => trans('Modules::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, Book::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}