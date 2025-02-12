#include <iostream>
#include <fstream>
#include <vector>

using namespace std;

const int MAX_N = 100; // Maximum number of rows
const int MAX_M = 100; // Maximum number of columns

// Function to check if a person can be placed at a certain position
bool canPlacePerson(char person, int row, int col, vector<vector<char> >& matrix) {
    // Check if any adjacent person has the same gender or facing direction
    int dx[] = {0, 0, -1, 1};
    int dy[] = {-1, 1, 0, 0};
    for (int i = 0; i < 4; i++) {
        int newRow = row + dx[i];
        int newCol = col + dy[i];
        if (newRow >= 0 && newRow < matrix.size() && newCol >= 0 && newCol < matrix[0].size()) {
            if (matrix[newRow][newCol] == person) {
                return false;
            }
        }
    }
    return true;
}

// Function to arrange people using backtracking
bool arrangePeople(int row, int col, vector<vector<char> >& matrix, vector<char>& people) {
    if (row == matrix.size()) {
        return true; // All rows are filled, solution found
    }

    for (char person : people) {
        if (canPlacePerson(person, row, col, matrix)) {
            matrix[row][col] = person; // Place the person
            int nextRow = row;
            int nextCol = col + 1;
            if (nextCol == matrix[0].size()) {
                nextRow++;
                nextCol = 0;
            }
            if (arrangePeople(nextRow, nextCol, matrix, people)) {
                return true; // If solution found, return true
            }
            matrix[row][col] = ' '; // Backtrack if solution not found
        }
    }

    return false; // No solution found for the current position
}

// Function to display the 2D array
void displayMatrix(vector<vector<char> >& matrix) {
    for (const auto& row : matrix) {
        for (char person : row) {
            cout << person << " ";
        }
        cout << endl;
    }
}

int main() {
    ifstream inputFile("desktop/file.txt");
    if (!inputFile) {
        cout << "Error opening the file." << endl;
        return 1;
    }

    vector<char> people;
    char person;
    while (inputFile >> person) {
        people.push_back(person);
    }
    inputFile.close();

    int n, m;
    cout << "Enter the number of rows (n): ";
    cin >> n;
    cout << "Enter the number of columns (m): ";
    cin >> m;

    if (n * m != people.size()) {
        cout << "Invalid number of elements in the file." << endl;
        return 1;
    }

    vector<vector<char> > matrix(n, vector<char>(m, ' '));

    if (arrangePeople(0, 0, matrix, people)) {
        cout << "Arrangement found:" << endl;
        displayMatrix(matrix);
    } else {
        cout << "No possible arrangement found." << endl;
    }

    return 0;
}
