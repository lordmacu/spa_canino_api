<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePopularRequest;
use App\Http\Requests\UpdatePopularRequest;
use App\Repositories\PopularRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class PopularController extends AppBaseController
{
    /** @var  PopularRepository */
    private $popularRepository;

    public function __construct(PopularRepository $popularRepo)
    {
        $this->popularRepository = $popularRepo;
    }

    /**
     * Display a listing of the Popular.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $populars = $this->popularRepository->all();

        return view('populars.index')
            ->with('populars', $populars);
    }

    /**
     * Show the form for creating a new Popular.
     *
     * @return Response
     */
    public function create()
    {
        return view('populars.create');
    }

    /**
     * Store a newly created Popular in storage.
     *
     * @param CreatePopularRequest $request
     *
     * @return Response
     */
    public function store(CreatePopularRequest $request)
    {
        $input = $request->all();

        $popular = $this->popularRepository->create($input);

        Flash::success('Popular saved successfully.');

        return redirect(route('populars.index'));
    }

    /**
     * Display the specified Popular.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $popular = $this->popularRepository->find($id);

        if (empty($popular)) {
            Flash::error('Popular not found');

            return redirect(route('populars.index'));
        }

        return view('populars.show')->with('popular', $popular);
    }

    /**
     * Show the form for editing the specified Popular.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $popular = $this->popularRepository->find($id);

        if (empty($popular)) {
            Flash::error('Popular not found');

            return redirect(route('populars.index'));
        }

        return view('populars.edit')->with('popular', $popular);
    }

    /**
     * Update the specified Popular in storage.
     *
     * @param int $id
     * @param UpdatePopularRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePopularRequest $request)
    {
        $popular = $this->popularRepository->find($id);

        if (empty($popular)) {
            Flash::error('Popular not found');

            return redirect(route('populars.index'));
        }

        $popular = $this->popularRepository->update($request->all(), $id);

        Flash::success('Popular updated successfully.');

        return redirect(route('populars.index'));
    }

    /**
     * Remove the specified Popular from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $popular = $this->popularRepository->find($id);

        if (empty($popular)) {
            Flash::error('Popular not found');

            return redirect(route('populars.index'));
        }

        $this->popularRepository->delete($id);

        Flash::success('Popular deleted successfully.');

        return redirect(route('populars.index'));
    }
}
