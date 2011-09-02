'''

'''

from Decision.Comparison.CompareAbstract import CompareAbstract


class LessThan(CompareAbstract):
	
	
	def compare(self):
		
		return self.contextVar < self.configVar